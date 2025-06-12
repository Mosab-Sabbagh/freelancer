@extends('jobSeeker.layouts.app')
@section('title', 'تأكيد عملية الاستلام')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> تأكيد عملية الاستلام</div>
                    <div class="card-body">
                        <p>اضغط لتأكيد عملية التحويل اليك المبلغ المتفق عليه مقابل المشروع الذي تم تنفيذه</p>
                        <p>شكراً لك، عمل موفق! </p>
                        <form action="{{route('payment.confirm')}}" method="post">
                            @csrf
                            <input type="hidden" name="payment_id" value="{{request()->route('payment_id')}}">
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection