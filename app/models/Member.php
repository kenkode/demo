<?php

class Member extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'fname' => 'required',
		 'lname' => 'required',
		 'membership_no' => 'required',
		 'branch_id' => 'required'
	];

	public static $messages = array(
        'fname.required'=>'Please insert bank name!',
        'lname.required'=>'Please insert email address!',
        'membership_no.required'=>'Please insert membership number!',
        'membership_no.unique'=>'That membership number address already exists!',
        'branch_id.unique'=>'Please select branch!',
        
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function branch(){

		return $this->belongsTo('Branch');
	}

	public function group(){

		return $this->belongsTo('Group');
	}

	public function kins(){

		return $this->hasMany('Kin');
	}


	public function savingaccounts(){

		return $this->hasMany('Savingaccount');
	}


	public function shareaccount(){

		return $this->hasOne('Shareaccount');
	}



	public function loanaccounts(){

		return $this->hasMany('Loanaccount');
	}


    public function employee(){

		return $this->hasOne('Employee');
	}

	public function guarantors(){

		return $this->hasMany('Loanguarantor');
	}
	
	public static function getBank($id){
	     if($id == 0){
	      return '';
	    }else{
	      return Bank::where('id',$id)->pluck('bank_name');
      	   }
	}


	public static function getMemberAccount($id){

		$account_id = DB::table('savingaccounts')
					->where('organization_id',Confide::user()->organization_id)
					->where('member_id', '=', $id)
					->pluck('id');
		$account = Savingaccount::find($account_id);
		return $account;
	}

	public static function getMember($id){
        
        $remittance = 0.00;

        if($id == 0 || $id == null){
        $remittance = 0.00;
        }else{
		$member = DB::table('members')
					->where('organization_id',Confide::user()->organization_id)
					->where('id', '=', $id)
					->first();

	    $remittance = $member->monthly_remittance_amount;

	    }
		return $remittance;
	}

	public static function getGroup($id){
        
        $groupid = '';

        if($id == 0 || $id == null){
        $groupid = '';
        }else{
		$member = DB::table('members')
					->where('organization_id',Confide::user()->organization_id)
					->where('id', '=', $id)
					->first();

	    $groupid = $member->group_id;

	    }
		return $groupid;
	}
}