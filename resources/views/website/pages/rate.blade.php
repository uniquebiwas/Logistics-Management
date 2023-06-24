
@extends('layouts.front')
@section('page_title', @$pagedata->title['en'] ?? @$pagedata->title['np'])
@section('meta')
    @include('website.pages.meta')
@endsection
@section('content')


<style>
    .rate-form {
    margin: 70px 0 30px;
}

.rate-form-wrap {
    max-width: 450px;
    margin: auto;
    background: #fff;
    padding: 30px;
    box-shadow: 0px 0px 20px rgb(0 0 0 / 20%);
    border-radius: 4px;
}

.rate-form-wrap h3 {
    background: #6c0c0d;
    color: #fff;
    padding: 10px 15px;
    font-size: 20px;
    margin-top: -30px;
    margin-left: -30px;
    margin-right: -30px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

.rate-form-wrap p {
    margin-top: 20px;
    font-size: 18px;
    margin-bottom: 0;
}

.rate-form-wrap form {
    margin-top: 20px;
}

.rate-form-wrap label {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 5px;
}

.rate-form-wrap .form-control {
    height: 32px;
    font-size: 14px;
    border-radius: 3px;
}

.rate-form-wrap .form-group {
    margin-bottom: 15px;
}
.rate-form-wrap .btn {
    background: #c02126;
    border: none;
    border-radius: 3px;
    margin-top: 10px;
}
</style>


<div class="rate-form">
    <div class="container">
        <div class="rate-form-wrap">
            <h3>Check Shipment Price</h3>
            <p>Quick price checker for your shipment specifications.</p>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Nepal</option>
                                <option value="1">India</option>
                                <option value="2">Australia</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Nepal</option>
                                <option value="1">India</option>
                                <option value="2">Australia</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Integrator</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>DHL</option>
                                <option value="1">FEDEX</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" placeholder="Weight" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Check Price</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection