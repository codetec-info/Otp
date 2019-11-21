@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter OTP</div>

                <div class="card-body">
                    @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('verify.post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            {{--  <label for="otp">Enter your OTP</label>  --}}
                            <input type="text" name="OTP" id="otp" class="form-control" required value="{{ $otp }}">
                        </div>
                        <input type="submit" value="Verify" class="btn btn-info float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
