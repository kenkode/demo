<?php

class MembersController extends \BaseController {




	/**
	 * Display a listing of members
	 *
	 * @return Response
	 */
	public function index()
	{
		$members = Member::where('organization_id',Confide::user()->organization_id)->get();
		return View::make('members.index', compact('members'));
	}


	public function members(){
		//$members = Member::all();
		$pdf = PDF::loadView('pdf.blank')->setPaper('a4')->setOrientation('potrait');
		return $pdf->stream('MemberList.pdf');		
	}

	
	/**
	 * Show the form for creating a new member
	 *
	 * @return Response
	 */
	public function create()
	{		
		$this->beforeFilter('limit');
        $count = DB::table('members')
        ->where('organization_id',Confide::user()->organization_id)
        ->count();
        $mno   =  001;
        if($count > 0){
          $member = Member::where('organization_id',Confide::user()->organization_id)
          ->orderBy('id', 'DESC')->first();
          $m = preg_replace('/\D/', '', $member->membership_no);
          $mno   =  sprintf("%03d",$m+1);
        }else{
          $mno   =  001;
        }
		$banks = Bank::where('organization_id',Confide::user()->organization_id)->orWhereNull('organization_id')->get();
		$currency = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->first();
		$bbranches = BBranch::where('organization_id',Confide::user()->organization_id)->get();
		$branches = Branch::where('organization_id',Confide::user()->organization_id)->get();
		$groups = Group::where('organization_id',Confide::user()->organization_id)->get();
		$savingproducts = Savingproduct::where('organization_id',Confide::user()->organization_id)
		->get();
		return View::make('members.create', compact('branches','currency', 'mno', 'banks', 'bbranches', 'groups', 'savingproducts'));
	}

	/**
	 * Store a newly created member in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Member::$rules, Member::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $empphoto = '';
        $empsig = '';
        $employeeId = '';
		$member = new Member;

		if(Input::get('branch_id') != null){

			$branch = Branch::findOrFail(Input::get('branch_id'));
			$member->branch()->associate($branch);
		}
		
		if(Input::get('group_id') != null){

			$group = Group::findOrFail(Input::get('group_id'));
			$member->group()->associate($group);
		}
		if(Input::hasFile('photo')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('photo')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			$empphoto = $photo;
			
			Input::file('photo')->move($destination, $photo);

			
			$member->photo = $photo;
			
		}
		if(Input::hasFile('signature')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('signature')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			$empsig = $photo;
			Input::file('signature')->move($destination, $photo);

			
			$member->signature = $photo;
			
		}

        if(Input::get('mname') != "" || Input::get('mname') != null){
          $member->name = Input::get('fname')." ".Input::get('mname')." ".Input::get('lname');
        }else{
          $member->name = Input::get('fname')." ".Input::get('lname');
        }
		
		$member->id_number = Input::get('mid_number');
		$member->first_name = Input::get('fname');
		$member->last_name = Input::get('lname');
		$member->middle_name = Input::get('mname');
		$member->membership_no = Input::get('membership_no');
		$member->phone = Input::get('phone');
		$member->email = Input::get('email');
		$member->address = Input::get('address');
		$member->bank_id = Input::get('bank_id');
		$member->bank_branch_id = Input::get('bbranch_id');
		$member->bank_account_number = Input::get('bank_acc');
		$member->monthly_remittance_amount = Input::get('monthly_remittance_amount');
		$member->gender = Input::get('gender');
		$member->organization_id=Confide::User()->organization_id;
		if(Input::get('active') == '1'){
			$member->is_active = TRUE;
		} else {
			$member->is_active = FALSE;
		}

		if(Input::get('is_employee') == '1'){
			$member->is_employee = 1;
		} else {
			$member->is_employee = 0;
		}

		$member->save();
		$member_id = $member->id;

        
        if(Input::get('is_employee') == '1'){
		$employee = new Employee;

	    $employee->photo = $empphoto;
		$employee->signature = $empsig;
		$employee->branch_id = Input::get('branch_id');
		$employee->member_id = $member_id;
		$employee->organization_id = Confide::user()->organization_id;
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->telephone_mobile = Input::get('phone');
		$employee->email_office = Input::get('email');
		$employee->postal_address = Input::get('address');
		$employee->bank_id = Input::get('bank_id');
		$employee->bank_branch_id = Input::get('bbranch_id');
		$employee->identity_number = Input::get('mid_number');
		$employee->personal_file_number = Input::get('membership_no');
		if(Input::get('gender') == 'M'){
          $employee->gender = 'male';
		}else if(Input::get('gender') == 'F'){
          $employee->gender = 'female';
		}else{
		  $employee->gender = Input::get('gender');
		}
		if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
        if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
	    $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
	    $employee->in_employment = 'Y';
		$employee->save();
		$employeeId = $employee->id;
	    }

	    
		
		//if(Input::get('share_account') == '1'){
			Shareaccount::createAccount($member_id);
		//}

        $insertedId = $member->id;

        Kin::where('member_id', $insertedId)->delete();
        for ($i=0; $i <count(Input::get('kin_first_name')) ; $i++) { 
        # code...
        
        if((Input::get('kin_first_name')[$i] != '' || Input::get('kin_first_name')[$i] != null) && (Input::get('kin_last_name')[$i] != '' || Input::get('kin_last_name')[$i] != null)){
        $kin = new Kin;
        $kin->member_id=$insertedId;
        $kin->first_name = Input::get('kin_first_name')[$i];
        $kin->last_name = Input::get('kin_last_name')[$i];
        $kin->middle_name = Input::get('kin_middle_name')[$i];
        if(Input::get('kin_middle_name')[$i] != "" || Input::get('kin_middle_name')[$i] != null){
          $kin->name = Input::get('kin_first_name')[$i]." ".Input::get('kin_middle_name')[$i]." ".Input::get('kin_last_name')[$i];
        }else{
          $kin->name = Input::get('kin_first_name')[$i]." ".Input::get('kin_last_name')[$i];
        }
        $kin->goodwill = Input::get('goodwill')[$i];
        $kin->rship = Input::get('relationship')[$i];
        $kin->contact = Input::get('contact')[$i];
        $kin->id_number = Input::get('id_number')[$i];
        $kin->organization_id=Confide::User()->organization_id;
        $kin->save();

        $empkin = new Nextofkin;
        $empkin->member_id=$insertedId;
        $empkin->employee_id=$employeeId;
        $empkin->first_name = Input::get('kin_first_name')[$i];
        $empkin->last_name = Input::get('kin_last_name')[$i];
        $empkin->middle_name = Input::get('kin_middle_name')[$i];
        $empkin->relationship = Input::get('relationship')[$i];
        $empkin->contact = Input::get('contact')[$i];
        $empkin->id_number = Input::get('id_number')[$i];

        $empkin->save();

       }
     }

		$files = Input::file('path');
        $j = 0;

        if($files != '' || $files != null){

       foreach($files as $file){
       
       if ( Input::hasFile('path')){
        $document= new Document;
        
        $document->member_id = $insertedId;
        $name = $file->getClientOriginalName();
        $file = $file->move('public/uploads/documents/', $name);
        $input['file'] = '/public/uploads/documents/'.$name;
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $document->document_path = $name;
        $document->organization_id=Confide::User()->organization_id;
        $document->save();
        $j=$j+1;
       }
       }

	   }

	
		Audit::logAudit(date('Y-m-d'), Confide::user()->username, 'member creation', 'Member', '0');


		return Redirect::route('members.index');
	}

	/**
	 * Display the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$member = Member::where('id','=',$id)->get()->first();

		$documents = Document::where('employee_id',$id)
		->where('organization_id',Confide::User()->organization_id)
		->get();

		$savingaccounts = $member->savingaccounts;
		$shareaccount = $member->shareaccount;

        if(Confide::user()->user_type == 'member'){
        	return View::make('css.showmembercss', compact('member', 'savingaccounts', 'shareaccount'));
        }else{

		return View::make('members.show', compact('member', 'documents', 'savingaccounts', 'shareaccount'));
	}
	}

	/**
	 * Show the form for editing the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$member = Member::find($id);
		$branches = Branch::where('organization_id',Confide::user()->organization_id)->get();
		$currency = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->first();
		$kins = Kin::where('member_id',$id)->where('organization_id',Confide::user()->organization_id)->get();
		$banks = Bank::where('organization_id',Confide::user()->organization_id)->orWhereNull('organization_id')->get();
		$bbranches = BBranch::where('bank_id',$member->bank_id)
		->where('organization_id',Confide::user()->organization_id)->get();
		$documents = Document::where('employee_id',$id)
		->where('organization_id',Confide::user()->organization_id)->get();
		$count = Document::where('employee_id',$id)
		->where('organization_id',Confide::user()->organization_id)->count();
		$countk = Kin::where('member_id',$id)
		->where('organization_id',Confide::user()->organization_id)->count();
		$groups = Group::where('organization_id',Confide::user()->organization_id)->get();

		if(Confide::user()->user_type == 'member' || Confide::user()->user_type == 'employee'){
        	return View::make('css.editmembercss', compact('member','currency', 'countk', 'kins','banks', 'bbranches','count', 'documents', 'branches', 'groups'));
        }else{
        
		return View::make('members.edit', compact('member', 'currency','countk', 'kins','banks', 'bbranches','count', 'documents', 'branches', 'groups'));
	}
	}


	/**
	 * Update the specified member in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$member = Member::findOrFail($id);
		$empphoto = '';
		$empsig = '';

		$validator = Validator::make($data = Input::all(), Member::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if(Input::get('branch_id') != null){

			$branch = Branch::findOrFail(Input::get('branch_id'));
			$member->branch()->associate($branch);
		}
		
		if(Input::get('group_id') != null){

			$group = Group::findOrFail(Input::get('group_id'));
			$member->group()->associate($group);
		}

		//$member->photo = Input::get('photo');
		//$member->signature = Input::get('signature');

		if(Input::hasFile('photo')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('photo')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('photo')->move($destination, $photo);

			
			$member->photo = $photo;

			$empphoto = $photo;
			
			
		}else{
            $empphoto = $member->photo;
		}


		if(Input::hasFile('signature')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('signature')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('signature')->move($destination, $photo);

			
			$member->signature = $photo;

			$empsig = $photo;
			
		}else{
			$empsig = $member->signature;
		}

        if(Input::get('mname') != "" || Input::get('mname') != null){
          $member->name = Input::get('fname')." ".Input::get('mname')." ".Input::get('lname');
        }else{
          $member->name = Input::get('fname')." ".Input::get('lname');
        }
		
		$member->id_number = Input::get('mid_number');
		$member->first_name = Input::get('fname');
		$member->last_name = Input::get('lname');
		$member->middle_name = Input::get('mname');
		$member->membership_no = Input::get('membership_no');
		$member->phone = Input::get('phone');
		$member->email = Input::get('email');
		$member->address = Input::get('address');
		$member->bank_id = Input::get('bank_id');
		$member->bank_branch_id = Input::get('bbranch_id');
		$member->bank_account_number = Input::get('bank_acc');
		$member->monthly_remittance_amount = Input::get('monthly_remittance_amount');
		$member->gender = Input::get('gender');

        if(Input::get('is_employee') == '1'){
			$member->is_employee = 1;
		} else {
			$member->is_employee = 0;
		}

		$member->update();

		$insertedId = $member->id;

		$count = Member::where('id',$insertedId)
		->where('organization_id',Confide::user()->organization_id)->count();
		$empid = 0;

	
		if(Input::get('is_employee') == '1' && $count == 0){
		$employee = new Employee;
		$employee->photo = $empphoto;
	    $employee->signature = $empsig;
		$employee->branch_id = Input::get('branch_id');
		$employee->member_id = $insertedId;
		$employee->organization_id = Confide::user()->organization_id;
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->telephone_mobile = Input::get('phone');
		$employee->email_office = Input::get('email');
		$employee->postal_address = Input::get('address');
		$employee->bank_id = Input::get('bank_id');
		$employee->bank_branch_id = Input::get('bbranch_id');
		$employee->identity_number = Input::get('mid_number');
		$employee->personal_file_number = Input::get('membership_no');
		if(Input::get('gender') == 'M'){
          $employee->gender = 'male';
		}else if(Input::get('gender') == 'F'){
          $employee->gender = 'female';
		}else{
		  $employee->gender = Input::get('gender');
		}
		if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
        if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
	    $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
	    $employee->in_employment = 'Y';
		$employee->save();
		$empid = $employee->id;
	    }
	    else if(Input::get('is_employee') == '1' && $count > 0){
	    $employee = Employee::where('member_id',$insertedId)->first();
	    $employee->photo = $empphoto;
	    $employee->signature = $empsig;
		$employee->branch_id = Input::get('branch_id');
		$employee->member_id = $insertedId;
		$employee->organization_id = Confide::user()->organization_id;
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->telephone_mobile = Input::get('phone');
		$employee->email_office = Input::get('email');
		$employee->postal_address = Input::get('address');
		$employee->bank_id = Input::get('bank_id');
		$employee->bank_branch_id = Input::get('bbranch_id');
		$employee->identity_number = Input::get('mid_number');
		$employee->personal_file_number = Input::get('membership_no');
		if(Input::get('gender') == 'M'){
          $employee->gender = 'male';
		}else if(Input::get('gender') == 'F'){
          $employee->gender = 'female';
		}else{
		  $employee->gender = Input::get('gender');
		}
		if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
        if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
	    $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
	    $employee->in_employment = 'Y';
		$employee->update();
		$empid = $employee->id;
	    }else if(Input::get('is_employee') != '1' && $count > 0){
        $employee = Employee::where('member_id',$insertedId)->first();
        $employee->photo = $empphoto;
	    $employee->signature = $empsig;
		$employee->branch_id = Input::get('branch_id');
		$employee->member_id = $insertedId;
		$employee->organization_id = Confide::user()->organization_id;
		$employee->first_name = Input::get('fname');
		$employee->last_name = Input::get('lname');
		$employee->middle_name = Input::get('mname');
		$employee->telephone_mobile = Input::get('phone');
		$employee->email_office = Input::get('email');
		$employee->postal_address = Input::get('address');
		$employee->bank_id = Input::get('bank_id');
		$employee->bank_branch_id = Input::get('bbranch_id');
		$employee->identity_number = Input::get('mid_number');
		$employee->personal_file_number = Input::get('membership_no');
		if(Input::get('gender') == 'M'){
          $employee->gender = 'male';
		}else if(Input::get('gender') == 'F'){
          $employee->gender = 'female';
		}else{
		  $employee->gender = Input::get('gender');
		}
		if(Input::get('pin') != null){
		$employee->pin = Input::get('pin');
		}else{
        $employee->pin = null;
	    }
	    if(Input::get('social_security_number') != null){
		$employee->social_security_number = Input::get('social_security_number');
	    }else{
        $employee->social_security_number = null;
	    }
	    if(Input::get('hospital_insurance_number') != null){
		$employee->hospital_insurance_number = Input::get('hospital_insurance_number');
	    }else{
        $employee->hospital_insurance_number = null;
	    }
        if(Input::get('i_tax') != null ){
		$employee->income_tax_applicable = '1';
	    }else{
	    $employee->income_tax_applicable = '0';
	    }
	    if(Input::get('i_tax_relief') != null ){
	    $employee->income_tax_relief_applicable = '1';
	    }else{
	    $employee->income_tax_relief_applicable = '0';
	    }
	    if(Input::get('a_nhif') != null ){
	    $employee->hospital_insurance_applicable = '1';
	    }else{
	    $employee->hospital_insurance_applicable = '0';
	    }
	    if(Input::get('a_nssf') != null ){
		$employee->social_security_applicable = '1';
	    }else{
	    $employee->social_security_applicable = '0';
	    }
	    $a = str_replace( ',', '', Input::get('pay') );
        $employee->basic_pay = $a;
	    $employee->in_employment = 'N';
		$employee->update();
		$empid = $employee->id;
	    }

        
        Kin::where('member_id', $insertedId)
        ->where('organization_id',Confide::user()->organization_id)->delete();

        Nextofkin::where('member_id', $insertedId)
        ->where('organization_id',Confide::user()->organization_id)->delete();

        for ($i=0; $i <count(Input::get('kin_first_name')) ; $i++) { 
        # code...
        
         if((Input::get('kin_first_name')[$i] != '' || Input::get('kin_first_name')[$i] != null) && (Input::get('kin_last_name')[$i] != '' || Input::get('kin_last_name')[$i] != null)){
        $kin = new Kin;
        $kin->member_id=$insertedId;
        if(Input::get('kin_middle_name')[$i] != "" || Input::get('kin_middle_name')[$i] != null){
          $kin->name = Input::get('kin_first_name')[$i]." ".Input::get('kin_middle_name')[$i]." ".Input::get('kin_last_name')[$i];
        }else{
          $kin->name = Input::get('kin_first_name')[$i]." ".Input::get('kin_last_name')[$i];
        }
        $kin->first_name = Input::get('kin_first_name')[$i];
        $kin->last_name = Input::get('kin_last_name')[$i];
        $kin->middle_name = Input::get('kin_middle_name')[$i];
        $kin->goodwill = Input::get('goodwill')[$i];
        $kin->rship = Input::get('relationship')[$i];
        $kin->contact = Input::get('contact')[$i];
        $kin->id_number = Input::get('id_number')[$i];
        $kin->organization_id=Confide::User()->organization_id;
        $kin->save();

        $empkin = new Nextofkin;
        $empkin->member_id=$insertedId;
        $empkin->employee_id=$insertedId;
        $empkin->first_name = Input::get('kin_first_name')[$i];
        $empkin->last_name = Input::get('kin_last_name')[$i];
        $empkin->middle_name = Input::get('kin_middle_name')[$i];
        $empkin->relationship = Input::get('relationship')[$i];
        $empkin->contact = Input::get('contact')[$i];
        $empkin->id_number = Input::get('id_number')[$i];
        $empkin->organization_id=Confide::User()->organization_id;
        $empkin->save();

       }
     }


		$files = Input::file('path');
        $j = 0;

        if($files != '' || $files != null){

       foreach($files as $file){
       
       if ( Input::hasFile('path')){
        $document= new Document;
        
        $document->member_id = $insertedId;
        $name = $file->getClientOriginalName();
            $file = $file->move('public/uploads/documents/', $name);
            $input['file'] = '/public/uploads/documents/'.$name;
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $document->document_path = $name;
            $document->organization_id=Confide::User()->organization_id;
        $document->save();
        $j=$j+1;
       }
       }

	   }

        if(Confide::user()->user_type == 'member'){
        return Redirect::to('/member')->withFlashMessage('You have successfully updated your membership details!');
        }else{
		return Redirect::route('members.index');
	}

	}

	
	/**
	 * Remove the specified member from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Member::destroy($id);

		return Redirect::route('members.index');
	}



	public function loanaccounts($id)
	{
		$member = Member::findOrFail($id);

		return View::make('members.loanaccounts', compact('member'));
	}


	public function activateportal($id){

		$member = Member::find($id);
		$organization = Organization::where('organization_id',Confide::user()->organization_id)
		->get();
		$password = strtoupper(Str::random(8));


        $email = $member->email;
        $phone = $member->phone;
        $name = $member->name;

      //  if($phone != null){

        /*include(app_path() . '\views\AfricasTalkingGateway.php');
    // Specify your login credentials
    $username   = "kenkode";
    $apikey     = "7876fef8a4303ec6483dfa47479b1d2ab1b6896995763eeb620b697641eba670";
    // Specify the numbers that you want to send to in a comma-separated list
    // Please ensure you include the country code (+254 for Kenya in this case)
    $recipients = $phone;
    // And of course we want our recipients to know what we really do
    $message    = "Hello ".$name.",
    Your self service portal account has been activated 
    Below is your login credentials:
    1. Username - ".$member->membership_no."
    2. Password - ".$password."
    Regards,
    ".$organization->name;
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    // Any gateway error will be captured by our custom Exception class below, 
    // so wrap the call in a try-catch block
    try 
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);
      DB::table('users')->insert(
	  array('email' => $member->email,
	  'phone' => $member->phone, 
	  'username' => $member->membership_no,
	  'password' => Hash::make($password),
	  'user_type'=>'member',
	  'confirmation_code'=> md5(uniqid(mt_rand(), true)),
	  'confirmed'=> 1
		)
);
            

        $member->is_css_active = true;
		$member->update();

       return Redirect::back()->with('notice', 'Member has been activated and login credentials sent to their phone number');

      /*foreach($results as $result) {
        // status is either "Success" or "error message"
        echo " Number: " .$result->number;
        echo " Status: " .$result->status;
        echo " MessageId: " .$result->messageId;
        echo " Cost: "   .$result->cost."\n";
      }*/
   /* }
    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while sending: ".$e->getMessage();
    }*/

		if($email != null){

		DB::table('users')->insert(
	array('email' => $member->email, 
	  'username' => $member->membership_no,
	  'password' => Hash::make($password),
	  'user_type'=>'member',
	  'organization_id'=>Confide::user()->organization_id,
	  'confirmation_code'=> md5(uniqid(mt_rand(), true)),
	  'confirmed'=> 1
		)
);

		$member->is_css_active = true;
		$member->update();





	Mail::send( 'emails.password', array('password'=>$password, 'name'=>$name), function( $message ) use ($member)
{
    $message->to($member->email )->subject( 'Self Service Portal Credentials' );
});


       return Redirect::back()->with('notice', 'Member has been activated and login credentials sent to their email address');



		

}

else{

	return Redirect::back()->with('notice', 'Member has not been activated kindly update phone number');

}





		

	}



	public function deactivateportal($id){

		
		$member = Member::find($id);

		DB::table('users')->where('username', '=', $member->membership_no)->delete();

		$member->is_css_active = false;
		$member->update();


	/*if($member->phone != null){

    include(app_path() . '\views\AfricasTalkingGateway.php');
    // Specify your login credentials
    $username   = "kenkode";
    $apikey     = "7876fef8a4303ec6483dfa47479b1d2ab1b6896995763eeb620b697641eba670";
    // Specify the numbers that you want to send to in a comma-separated list
    // Please ensure you include the country code (+254 for Kenya in this case)
    $recipients = $phone;
    // And of course we want our recipients to know what we really do
    $message    = "Hello ".$name.",
    Your self service portal account has been deactivated 
    Regards,
    ".$organization->name;
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    // Any gateway error will be captured by our custom Exception class below, 
    // so wrap the call in a try-catch block
    try 
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);

       return Redirect::back()->with('notice', 'Member has been successfully deactivated');

      /*foreach($results as $result) {
        // status is either "Success" or "error message"
        echo " Number: " .$result->number;
        echo " Status: " .$result->status;
        echo " MessageId: " .$result->messageId;
        echo " Cost: "   .$result->cost."\n";
      }*/
   /* }
    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while sending: ".$e->getMessage();
    }
*/
		/*if($email != null){

		DB::table('users')->insert(
	array('email' => $member->email, 
	  'username' => $member->membership_no,
	  'password' => Hash::make($password),
	  'user_type'=>'member',
	  'confirmation_code'=> md5(uniqid(mt_rand(), true)),
	  'confirmed'=> 1
		)
);

		$member->is_css_active = true;
		$member->update();





	Mail::send( 'emails.password', array('password'=>$password, 'name'=>$name), function( $message ) use ($member)
{
    $message->to($member->email )->subject( 'Self Service Portal Credentials' );
});*/


	return Redirect::back()->with('notice', 'Member has been successfully deactivated');


}
	public function savingtransactions($acc_id){
		 $account = Savingaccount::findorfail($acc_id);
		 $balance = Savingaccount::getAccountBalance($account);
    	 return View::make('css.savingtransactions', compact('account', 'balance'));
	}
	public function loanaccounts2(){
		$mem = Confide::user()->username;
		$id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');
		$member = Member::findOrFail($id);
		return View::make('css.loanaccounts', compact('member'));
	}
	public function reset($id){
		//$id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');
		$member = Member::findOrFail($id);
		$user_id = DB::table('users')->where('username', '=', $member->membership_no)
		->where('organization_id',Confide::User()->organization_id)
		->pluck('id');		
		$user = User::findOrFail($user_id);		
		$user->password = Hash::make('tacsix123');
		$user->update();
		
		return Redirect::back();
		
	}
     
    public function deletedoc(){
		
		//$id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');\

        Document::destroy(Input::get('id'));

		return 0;
		
	}
}
