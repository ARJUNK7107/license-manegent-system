@extends('layouts.app')

@section('content')
<h1>Edit Company</h1>

<form action="/companies/{{$company['id']}}" method="POST">
    @csrf
    @method('PATCH')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $company->name }}" required><br><br>
     
    <label for="create_date">Created Date:</label><br>
    <input type="date" id="create_date" name="create_date" value="{{ $company->create_date }}" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $company->email }}" required><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $company->phone }}" required><br><br>

    <label>Address:</label>
    <input type="text" name="address" value="{{ $company->address }}" required><br><br>

    <label>Tax Code:</label>
    <input type="text" name="tax_code" value="{{ $company->tax_code }}"><br><br>

    <button type="submit">Update</button>
    <a href="\companies">Cancel</a>
</form>
@endsection