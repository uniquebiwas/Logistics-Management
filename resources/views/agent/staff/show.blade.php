@extends('layouts.admin')
@section('title', 'Add New Users')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New User</h3>
                    <div class="card-tools">
                        <a href="{{ route('agent-staff.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
