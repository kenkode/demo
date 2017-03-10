@extends('layouts.member')
@section('content')
<br/>
<?php
function asMoney($value) {
  return number_format($value, 2);
}
?>
<div class="row">
  <div class="col-lg-5">
  @if(Session::has('none'))
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{{ Session::get('none') }}}</strong> 
      </div>      
   @endif  
   </div>
	<div class="col-lg-12">
  <h3>Loan Application</h3>
  <hr>
</div>	
</div>
<div class="row">
	<div class="col-lg-5">
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
       <table class="table table-condensed table-bordered">
        <tr>
          <td>Member</td><td>{{$loanaccount->member->name}}</td>
        </tr>
        <tr>
          <td>Loan Account</td><td>{{$loanaccount->account_number}}</td>
        </tr>
        <tr>
          <td>Loan Amount</td><td>{{ asMoney($loanaccount->amount_disbursed + $interest) }}</td>
        </tr>
        <tr>
          <td>Loan Balance</td><td>{{ asMoney($loanbalance) }}</td>
        </tr>
       </table> 
		 <form method="POST" action="{{{ URL::to('loanrepayments') }}}" accept-charset="UTF-8">
    <fieldset>
       <table class="table table-condensed table-bordered">
        <tr>
          <td>Principal Due</td><td>{{ asMoney($principal_due) }}</td>
        </tr>
        <tr>
          <td>Interest Due</td><td>{{ asMoney($interest_due) }}</td>
        </tr>
          <td>Amount Due</td><td>{{ asMoney($principal_due + $interest_due)}}</td>
        </tr>
        </table>
        <input class="form-control" placeholder="" type="hidden" name="loanaccount_id" id="loanaccount_id" value="{{ $loanaccount->id }}">
         <div class="form-group">
            <label for="username">Repayment Date <span style="color:red">*</span></label>
            <div class="right-inner-addon ">
            <i class="glyphicon glyphicon-calendar"></i>
            <input required class="form-control datepicker" readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{{ Input::old('date') }}}">
        </div>
       </div>
       <!--BEGIN VERBOTEN -->
       <input type="hidden" name="principal" value="{{$principal_due}}">
       <input type="hidden" name="interest" value="{{$interest_due}}">
       <!--END VERBOTEN-->
        <div class="form-group">
            <label for="username">Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" 
            value="{{{ Input::old('date') }}}">
        </div>
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary btn-sm">Submit Payment</button> 
        </div>
    </fieldset>
</form>
</div>
</div>
<!-- organizations Modal -->
<div class="modal fade" id="schedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Loan Schedule</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <div class="form-actions form-group">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@stop