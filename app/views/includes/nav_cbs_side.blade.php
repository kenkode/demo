<style type="text/css">
.dropdown-menu {
    margin-left: 100px;
}
</style>

 <nav class="navbar-default navbar-static-side" id="wrap" role="navigation">

            <div class="sidebar-collapse">

              <ul class="nav" id="side-menu">
                  <!-- <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-line-chart"></i>
                        Analytics     
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('trends') }}">
                            <i class="fa fa-user"></i> 
                            Trends
                        </a>
                    </li>    
                    <li>
                        <a href="{{ URL::to('trends') }}">
                            <i class="fa fa-user"></i> 
                            Forecast
                        </a>
                    </li>        
                    <li>
                        <a href="{{ URL::to('portal') }}">
                            <i class="fa fa-group"></i>
                            Members
                        </a>
                    </li>                                                    
                </ul>                 
            </li>  -->     
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-group"></i>Members     
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('members/create') }}">
                            <i class="fa fa-user"></i> 
                            New Member
                        </a>
                    </li>        
                    <li>
                        <a href="{{ URL::to('members') }}">
                            <i class="fa fa-group"></i>
                            Members
                        </a>
                    </li>                                                    
                </ul>                 
            </li>                       
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tags"></i>Loans <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">                    
                    <li>
                        <a href="{{ URL::to('disbursements') }}">
                            <i class="fa fa-random"></i> 
                            Disbursement Options
                        </a>
                    </li> 
                    <li>
                        <a href="{{ URL::to('matrices') }}">
                            <i class="fa fa-gavel"></i> 
                            Guarantor Matrix
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('loanproducts') }}">
                            <i class="glyphicon glyphicon-tags fa-fw"></i> 
                            Loan Products
                        </a>
                    </li>                    
                    <li>
                        <a href="{{ URL::to('loans') }}">
                            <i class="glyphicon glyphicon-pencil fa-fw"></i>
                             Loan Applications
                         </a>
                    </li>                                        
                </ul>                 
            </li>
             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-random"></i>Savings<i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('savingproducts/create') }}">
                            <i class="fa fa-plus"></i>
                            New Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('savingproducts') }}">
                            <i class="fa fa-random"></i>
                             Saving Products
                        </a>
                    </li> 
                </ul>                 
            </li>                       
             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-suitcase"></i>Share Capital<i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('shares/show/1') }}">
                            <i class="fa fa-cogs"></i>
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('sharecapital/contribution') }}">
                            <i class="fa fa-random"></i>
                           Contribution
                        </a>
                    </li> 
                    <li>
                        <a href="{{ URL::to('sharecapital/dividend') }}">
                            <i class="fa fa-table"></i>
                            Dividends
                        </a>
                    </li>                 
                </ul>                 
            </li>                                       
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-sliders"></i>Vendors <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('vendors/create') }}">
                            <i class="fa fa-plus"></i> 
                            New Vendor
                        </a>
                    </li> 
                    <li>
                        <a href="{{ URL::to('vendors') }}">     
                            <i class="fa fa-group"></i>
                            Vendors
                        </a>
                    </li> 
                </ul>                 
            </li>                                       
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-briefcase fa-fw"></i>Investments <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('investmentscats') }}"> 
                            <i class="fa fa-plus"></i>
                            New Category
                        </a>
                    </li>                            
                    <li>
                        <a href="{{ URL::to('saccoinvestments') }}">
                            <i class="fa fa-pencil"></i>
                            Investments
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('projects') }}">
                            <i class="fa fa-paw"></i>
                            Projects
                        </a>
                    </li>                            
                    <li>
                        <a href="{{ URL::to('projects/orders/show') }}">    
                            <i class="fa fa-pie-chart"></i>
                            Project Orders
                        </a>
                    </li>    
                </ul>                 
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-random"></i>Surplus <i class="fa fa-caret-down"></i>
                </a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('surplus') }}">
                            <i class="fa fa-gears"></i> 
                            Settings
                        </a>
                    </li> 
                    <li>
                        <a href="{{ URL::to('surplus/distribution') }}">     
                            <i class="fa fa-pie-chart"></i>
                            Distribution
                        </a>
                    </li> 
                </ul>                 
            </li>                
            <!--                                  
            <li>
                <a href="{{ URL::to('products') }}">
                    <i class="fa fa-table"></i>
                    Products
                </a>
            </li>
            <li>
                <a href="{{ URL::to('orders') }}">  
                    <i class="fa fa-archive"></i>
                    Orders
                </a>
            </li>-->
            <li>
                <a  href="{{ URL::to('reports')}}">
                    <i class="fa fa-file fa-fw"></i>
                      {{{ Lang::get('messages.nav.reports') }}}
                </a>    
            </li> 
            <li>
                <a  href="{{ URL::to('transaudits')}}">
                    <i class="fa fa-gears"></i>
                      Transactions
                </a>    
            </li> 

                  <?php
                    $organization = Organization::find(Confide::user()->organization_id);
                    $pcbs = (strtotime($organization->cbs_support_period)-strtotime(date("Y-m-d"))) / 86400;
                  ?>
                  @if($pcbs<0 && $organization->cbs_license_key ==1)
                     <h4 style="color:red">
                     Your annual support license for payroll product has expired!!!....
                     Please upgrade your license by clicking on the link below.</h4>
                     <a href="{{ URL::to('activatedproducts') }}">Upgrade license</a>
                  @else
                  @endif

              </div>

</nav>
                    
                   
   
                    
                </ul>
                <!-- /#side-menu -->
        </nav>
        <!-- /.navbar-static-side -->