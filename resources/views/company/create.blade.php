   @extends('layouts.app')
   @section('content')
    <h1>Create Company</h1>
    <form action="/company" method="POST">
        @csrf
        
        <label for="name">Company Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="create_date">Created Date:</label><br>
        <input type="date" id="create_date" name="create_date" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br><br>

        <label for="tax_code">Tax Code:</label><br>
        <input type="text" id="tax_code" name="tax_code" required><br><br>

        <button type="submit">Submit</button>
        <a href="\company">
            <button type="button">Cancel</button>
        </a>
    </form>
    @endsection