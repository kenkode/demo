@extends('layouts.help')
@section('content')
<br/>
<div class="row" style="margin-top: 5%;">
  <div class="col-lg-12">
    <div role="tabpanel">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active">
		    <a href="#remittance" aria-controls="remittance" role="tab" data-toggle="tab">
		    Xara CBS
		    </a>
	    </li>
	    <li role="presentation">
		    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
		    Xara Payroll
		    </a>
	    </li>
	    <li role="presentation">
		    <a href="#financials" aria-controls="financials" role="tab" data-toggle="tab">
		    Xara Financials
		    </a>
	    </li>
	  </ul>
	  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="remittance">
      <br>
      <div class="col-lg-12"> 
        <div class="panel panel-default">            
	        <div class="panel-body">
	        	<button data-toggle="collapse" data-target="#overallcbs" class="btn btn-info aria-controls col-lg-12" style="text-align: left;">
	        		XARA CBS SUMMARY
	        	</button>
				<div id="overallcbs" class="collapse col-lg-12">
					<p style="margin-top: 2%;">
					Xara Core Banking System(CBS) is an online system software that is geared towards easing the managenemt and administration tasks of the SACCOs and Microfinancial establishments.
					</p>
					<p>
						XARA CBS ensures proper running of the SACCOs and microfinances by automating the routine operations and providing an available platform that is accessible to both the SACCO members and the SACCO administrators and spells out the roles performed by different SACCO members that access the system.
					</p>
					<p>
						XARA CBS is organised into different interacting modules depicting the activities performed within a SACCO or microfinance. The modules are:
						<ol>
							<li>Member Management</li>
							<li>Savings Management</li>
							<li>Share Capital Management</li>
							<li>Loans Management</li>
							<li>Investment Management</li>
							<li>Reports Management</li>
							<li>Transactions Management</li>
							<li>Vendors Management</li>
						</ol>
					</p>
					<p>
						XARA CBS is SASRA-compliant and it includes a robust accounting module that spans all the activities within the SACCO. 
					</p>
					<p>
						XARA CBS supports both SMS and email notifications which occurs at crucial parts within the operation of the system such as loan approvals, guarantor approval et cetera. 
					</p>
					<p>
						XARA CBS has incorporated security features within the whole operation of the system.The system maintains a robust audit trail that records all the operations and activities within the system. The system also incorporates authentication and authorization mechanism to ensure proper usage of the system and consequently cushion the SACCOs and Microfinances from unforeseen lose through funds emezzlement and system misuse.
					</p>
					<p>
						Kindly watch the below XARA CBS OVERVIEW video tutorial to give you a feel of the system.						
					</p>
					<p style="margin-left: 12.5%;">
						<video width="500" controls>
						  <source src="{{ asset('public/uploads/videos/XARA CBS WALKTHROUGH.mp4')}}" type="video/mp4">						  
						  Your browser does not support HTML5 video.
						</video>						
					</p>
				</div>
	        	<button data-toggle="collapse" data-target="#member" class="btn btn-warning col-lg-12" style="text-align: left;">Member Management
	        	</button>
				<div id="member" class="collapse col-lg-12">
					<p style="margin-top: 5%;">
						After successful login into the system, you will be ushered into the system dashboard. On the dashboard there is a list of all available members.
					</p>
					<p>
						Member Management Module tackles all the tasks of creating, editing, retrieving details pertaining SACCO members.
					</p>
					<h3 style="text-decoration: underline;">Creating a New Member</h3>
					<p>
						<ol>
							<li>On the Left Navigation, click under the Member Submenu the New Member Link.
							</li>
							<li>
								Provide all the member details required and press Create Member Button to create a new member.
							</li>
						</ol>
					</p>
					<h3 style="text-decoration: underline;">Editing Member Details</h3>
					<p>
						<ol>
							<li>On the Dashboard list of members search for the particular member that details need to be edited, then click on the Manage Button for the respective member. 
							</li>
							<li>
								Click the Update Details Button on top of the member details displyed.
							</li>
							<li>
								Edit the member details required.
							</li>
							<li>Click Update Member Button</li>
						</ol>
					</p>
					<h3 style="text-decoration: underline;">Viewing Member Savings Details</h3>
					<p>
						<ol>
							<li>On the Dashboard list of members search for the particular member that details need to be edited, then click on the Savings Button for the respective member. 
							</li>
							<li>
								You can create a new saving account for the member, view savings transactions or carry out a savings transaction for the member.
							</li>							
						</ol>
					</p>
					<h3 style="text-decoration: underline;">Viewing Member Loan Details</h3>
					<p>
						<ol>
							<li>
							On the Dashboard list of members search for the particular member that details need to be edited, then click on the Loans Button for the respective member. 
							</li>
							<li>
								You can view all the loan accounts of the respective member or apply for the member a new loan.
							</li>							
						</ol>
					</p>
					<h3 style="text-decoration: underline;">Viewing Member Shares Details</h3>
					<p>
						<ol>
							<li>
							On the Dashboard list of members search for the particular member that details need to be edited, then click on the Shares Button for the respective member. 
							</li>
							<li>
								You can view the shares transactions for the respective member,or carry out share transaction for the given member.
							</li>							
						</ol>
					</p>
				</div>
				<button data-toggle="collapse" data-target="#saving" class="btn btn-success col-lg-12" style="text-align: left;">
					Saving Management
	        	</button>
				<div id="saving" class="collapse col-lg-12">
					<p style="margin-top: 5%;">
						XARA CBS allows the SACCO to define their own saving products so that their members can save for the defined products.
					</p>
					<p>
						<h3 style="text-decoration: underline;">Creating Saving Product</h3>
						<ol>
							<li>
								On the system dashboard, click on saving products link on the left navigation.
							</li>
							<li>
								From the submenu,click new product.
							</li>
							<li>
								Provide the product details.
							</li>
							<li>
								Click Create Product button.
							</li>
						</ol>
					</p>
				</div>
				<button data-toggle="collapse" data-target="#Sharecapital" class="btn btn-primary col-lg-12" style="text-align: left;">
					Share Capital Management
	        	</button>
				<div id="Sharecapital" class="collapse col-lg-12">
					<p style="margin-top: 5%;">
						XARA CBS share capital module allows members to observe their contribution to the operation of the SACCO and also reaping out of their saving in the SACCO through shares and dividends.
					</p>
					<p>
						Shares and dividends calculation are hinged upon the definition of the SACCO unit per share value.
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Share Settings
						</h3>
						<ol>
							<li>
								On the system dashboard, click on the Share Capital link.
							</li>
							<li>
								On the submenu click settings link.
							</li>
							<li>
								Click on the update link.
							</li>
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							View Contributions
						</h3>
						<ol>
							<li>
								On the system dashboard, click on the Share Capital link.
							</li>
							<li>
								On the submenu click contributions link.
							</li>							
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							View Dividends
						</h3>
						<ol>
							<li>
								On the system dashboard, click on the Share Capital link.
							</li>
							<li>
								On the submenu click dividends link.
							</li>							
						</ol>
					</p>
				</div>
				<button data-toggle="collapse" data-target="#loans" class="btn btn-info col-lg-12" style="text-align: left;">
					Loan Management
	        	</button>
				<div id="loans" class="collapse col-lg-12">
					<p style="margin-top: 5%;">
						XARA CBS loan management module is further subdivided into submodules namely: 
						Disbursement Options, Guarantor Matrix, Loan Products and Loan Applications.
					</p>
					<p>
						Disbursement Options specifies the mode upon which loans will be disbursed to the members, by specifying the minimum and the maximum amount that can be disbursed by a given option.
					</p>
					<p>
						Guarantor matrix specify other loan securities apart from loan guarantors required for huge development loans.
					</p>
					<p>Loan Products enables creation of various loan products for the SACCO.</p>
					<p>
						Loan Applications provide a detailed, categorised list of the loan aplications. The applications are categorized into the new applications, approved applications, rejected applications and disbursed applications.
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Applying loans for members
						</h3>
						<ol>
							<li>
								On the system dashboard, select the member to apply a loan for.
							</li>
							<li>
								Click on the Loans button on the row containing the respective member.
							</li>
							<li>
								Click New Loan Button on top of the list of loans previously applied for.
							</li>
							<li>
								Click Submit Application Button.
							</li>
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Approving loans for members
						</h3>
						<ol>
							<li>
								On the system dashboard,from the left navigation click loans.
							</li>
							<li>
								From the submenu click loan applications link.
							</li>
							<li>
								On the New Applications Tab, select the member you will like to approve the loan for.
							</li>
							<li>
								On the Action Button, click approve.
							</li>
							<li>
								View the Credit Appraissal form before approving the loan.
							</li>
							<li>
								Click Approve Loan Button.
							</li>
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Rejecting loans for members
						</h3>
						<ol>
							<li>
								On the system dashboard,from the left navigation click loans.
							</li>
							<li>
								From the submenu click loan applications link.
							</li>
							<li>
								On the New Applications Tab, select the member you will like to reject the loan for.
							</li>
							<li>
								On the Action Button, click reject.
							</li>
							<li>
								View the Credit Appraissal form before rejecting the loan.
							</li>
							<li>
								Click Reject Loan Button.
							</li>
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Disbursing loans for members
						</h3>
						<ol>
							<li>
								On the system dashboard, from the left navigation click loans.
							</li>
							<li>
								From the submenu click on loan applications link.
							</li>
							<li>
								Click on The approved Applications Tab.
							</li>
							<li>
								Select the application to disburse.
							</li>
							<li>
								On the action Button, click disburse.
							</li>
							<li>
								Go through the loan details specified.
							</li>
							<li>
								Click Disburse Loan Button.
							</li>
						</ol>
					</p>
					<p>
						<h3 style="text-decoration: underline;">
							Repaying loans for members
						</h3>
						<ol>
							<li>
								On the system dashboard, from the left navigation click loans.
							</li>
							<li>
								From the submenu click on loan applications link.
							</li>
							<li>
								Click on The Disbursed Applications Tab.
							</li>
							<li>
								On the action Button, click Manage.
							</li>
							<li>
								On the top right corner click the Repay Loan Button.
							</li>
							<li>
								Provide the amount of money received.
							</li>
							<li>
								Click Repay Loan Button.
							</li>
						</ol>
					</p>
				</div>
				<button data-toggle="collapse" data-target="#Investment" class="btn btn-warning col-lg-12" style="text-align: left;">
					Investment Management
	        	</button>
				<div id="Investment" class="collapse col-lg-12">
					<p style="margin-top: 3%;">
						Investment Management module provides an interactive platform for the SACCO members to positively grow the SACCO and individually. The module ensures members are updated on the SACCO projects which they can invest in and grow the asset base.
					</p>
					<p>
						The module is organised into four(4) submodules: Categories, Investments, Projects and Project Orders submodules.
					</p>
					<p>
						The module allows the system administrator to define New Investement categories, define New Investments into their matching Invetsments Categories already defined. The investments are later divided into projects which are sold by The SACCO to its members at a price depending with the apreciation/depreciation rate of the asset invested on by the SACCO.
					</p>
					<p>
						Once the system admin has divided the investments into projects, the members can view the projects in their own portals and choose to invest in ceratin units of the projects. Once they choose to invest in a project, the requested reaches the admin as a project order. The admin can approve/ reject the project depending upon the payment mode selected by the member.
					</p>
				</div>				
				<button data-toggle="collapse" data-target="#Reports" class="btn btn-primary col-lg-12" style="text-align: left;">
				 	Reports Management
	        	</button>
				<div id="Reports" class="collapse col-lg-12">
					<p style="margin-top: 3%;">
						Reports Management module provides an avenue for the system user to view detailed reports pertaining various sectors within the system.
					</p>
					<p>
						XARA CBS provide robust and SASRA-compliant reporting capabilities that serve majority of the SACCOs just fine unless customizations are needed.
					</p>
					<p>
						The Module is subdivided into submodules namely: Member reports, Share reports,Saving reports, Loan reports and financial reports submodules.
						Under each submodules there are categorised reports.
					</p>
					
				</div>				
			</div>
		</div>
      </div>      
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
      <br>
      <div class="col-lg-12">
	    <div class="panel panel-default">
		      <div class="panel-heading">
		         <p>
		         Loan Transactions		           
		         </p>
		      </div>
		    <div class="panel-body">    
		  	</div>
		</div>
      </div>
	</div>
    <div role="tabpanel" class="tab-pane" id="financials">
      <br>
      <div class="col-lg-12">
	    <div class="panel panel-default">
		      <div class="panel-heading">
		         <p>
		         	Xara Financials		           
		         </p>
		      </div>
		    <div class="panel-body">    
		  	</div>
		</div>
      </div>
	</div>
  </div>
 </div>
</div>
@stop