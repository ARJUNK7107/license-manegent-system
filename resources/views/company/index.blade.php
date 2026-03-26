  @extends('layouts.app')

  @section('content')
    <h1>Company</h1><br>
    <a href="/companies/create" class="btn-create">Create</a>

    <table style="width:70%; border-collapse: collapse;">
        <tr>
            <th style="border: 1px solid black; padding: 8px;">ID</th>
            <th style="border: 1px solid black; padding: 8px;">Name</th>
            <th style="border: 1px solid black; padding: 8px;">Created Date</th>
            <th style="border: 1px solid black; padding: 8px;">Email</th>
            <th style="border: 1px solid black; padding: 8px;">Phone</th>
            <th style="border: 1px solid black; padding: 8px;">Address</th>
            <th style="border: 1px solid black; padding: 8px;">Tax Code</th>
            <th style="border: 1px solid black; padding: 8px;">Created At</th>
            <th style="border: 1px solid black; padding: 8px;">Updated At</th>
            <th style="border: 1px solid black; padding: 8px;">Action</th>
        </tr>

        @foreach($companies as $company)
        <tr>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->id }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->name }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->create_date }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->email }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->phone }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->address }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->tax_code }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->created_at }}</td>
            <td style="border: 1px solid black; padding: 8px;">{{ $company->updated_at }}</td>
            <td style="border: 1px solid black; padding: 8px;">
                <a class="edit" href="/companies/{{$company['id']}}/edit">edit</a>

               <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                 @csrf
                 @method('DELETE')
                 <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
 
{{ $companies->links() }} 

@endsection