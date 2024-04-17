@extends('user.layouts.master')
@section('title', 'E-SHOP || Comment Page')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Add Recharge</h6>
            <a href="{{ route('user.withdrawal.index') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip"
                data-placement="bottom" title="Add User"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
        </div>
        <div class="card">
            <h5 class="card-header">Add Recharge</h5>
            <div class="card-body">
                <form method="post" action="{{ route('user.withdrawal.add') }}">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="amount" class="col-form-label">Amount<span class="text-danger">*</span></label>
                        <input id="amount" type="text" name="amount" placeholder="Enter amount" value=""
                            class="form-control">
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="purpose" class="col-form-label">Purpose</label>
                        <textarea id="purpose" name="purpose" placeholder="Enter purpose" class="form-control"></textarea>
                        @error('purpose')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
