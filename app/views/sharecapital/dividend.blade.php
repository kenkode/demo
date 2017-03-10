@extends('layouts.css')
@section('content')
<br/>
<div class="row">
	<div class="col-lg-12">
  <h3>Member Dividends</h3>
  <hr>
</div>	
</div>
<div class="row">
	<div class="col-lg-12">
        @if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif
        <?php
          $counter=Dividend::where('organization_id',Confide::User()->organization_id)->count();
        ?>        
    <div class="panel panel-default">
        @if($counter==0)
            <div class="panel-heading">
              <a href="{{URL::to('sharecapital/parameters')}}" class="btn btn-primary">
               Set Dividend Settings
              </a>
            </div>
        @endif
        @if($counter>=1)
            <div class="panel-heading">
              <a href="{{URL::to('sharecapital/editparameters')}}" class="btn btn-warning">
                Update Dividend Settings
              </a>
            </div>
        @endif
    <div class="panel-body">
      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">
      <thead>
        <th>#</th>
        <th>Member #</th>
        <th>Member Name</th>
        <th>Shares</th>        
        <th>Acc. Dividends</th>
      </thead>
      <tbody>
        <?php 
          $i = 1; 
          function asMoney($value){
            return number_format($value,2);
          }
          $sharecount=Share::where('organization_id',Confide::User()->organization_id)->count();
          if($sharecount>0){
                $sharevalue=Share::where('id','=',1)->where('organization_id',Confide::User()->organization_id)->pluck('value');
                switch($sharevalue){
                  case $sharevalue==0:
                    $sharevalue=0.00000009;
                    $count=Dividend::where('organization_id',Confide::User()->organization_id)->count();
                    if($count>0){
                      $pars=Dividend::where('id','=',1)->where('organization_id',Confide::User()->organization_id)->get()->first();
                      $top=$pars->total- $pars->special;
                      $multiplier=$top/$pars->outstanding;
                    }else if($count<=0){
                      $multiplier=0.0000000009;
                    }        
                  break;

                  case $sharevalue>0:
                    $count=Dividend::where('organization_id',Confide::User()->organization_id)->count();
                    if($count>0){
                      $pars=Dividend::where('id','=',1)->where('organization_id',Confide::User()->organization_id)->get()->first();
                      $top=$pars->total- $pars->special;
                      $multiplier=$top/$pars->outstanding;
                    }else if($count<=0){
                      $multiplier=0.0000000009;
                    }        
                  break;
                }                
          }else if($sharecount<=0){
                $sharevalue=0.000000009;
                $count=Dividend::where('organization_id',Confide::User()->organization_id)->count();
                if($count>0){
                  $pars=Dividend::where('id','=',1)->where('organization_id',Confide::User()->organization_id)->get()->first();
                  $top=$pars->total- $pars->special;
                  $multiplier=$top/$pars->outstanding;
                }else if($count<=0){
                  $multiplier=0.0000000009;
                }        
          }          
        ?>
        @foreach($members as $member)
        <tr>
          <td> {{ $i }}</td>
          <td>{{ $member->membership_no }}</td>
          <td>{{ $member->name }}</td>    
          <td>{{asMoney($contributions=Sharetransaction::where('shareaccount_id','=',$member->id)
          ->where('type','=','credit')->where('organization_id',Confide::User()->organization_id)
          ->sum('amount')/$sharevalue)}}</td>
          <td>{{asMoney($multiplier * $contributions)}}</td>
        </tr>
        <?php $i++; ?>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>
@stop