@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    {{-- bootstrap
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}


    <style>
        :root {
            --primary-color: #1F6268;
            --stroke-color: #599297;
            --secondary-color: #DDFAFD;
            --primary-text: #113437;
        }

        section {
            margin: 1rem 2.5rem;
            /* background: yellow; */
        }

        .module {
            font-size: 20px;
            /* font-weight: bold; */
            /* font-family: "Inter", sans-serif; */

        }

        .inter {
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-form {
            border-radius: 8px;
            display: flex;
            gap: 5px;
            padding: 4px;
            border: 2px solid var(--stroke-color);
            width: 500px;
        }

        .search-form__button {
            background: var(--primary-color);
            color: white;
            font-size: 13px;
            /* font-weight: bold; */
            padding: 6px 12px;
            border-radius: 8px;
            border: 2px solid var(--stroke-color);
            cursor: pointer;
            /* font-family: "Inter", sans-serif; */

        }

        .search-form__input {
            padding: 3px 5px;
            outline: none;
            border: none;
            font-weight: normal;
            font-size: 14px;
            flex: 1;
        }

        .table {
            width: 100%;
            margin: 30px 0;
            gap: 0;
            border: 1px solid black;
            border-collapse: collapse;
            text-align: left;
        }

        .table thead {
            background: var(--secondary-color);
        }

        .table th {
            color: var(--primary-text);
            font-weight: bold;
            font-family: "Inter", sans-serif;
            padding: 10px 0;


        }

        .table input {
            display: inline-block;
            margin-left: 10px;
        }

        ::placeholder {
            color: var(--primary-color);
            /* Change placeholder text color */
            font-weight: bold;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
            border-radius: 8px;
            font-size: 14px;
            border: 2px solid var(--stroke-color);
            padding: 10px 16px;
            cursor: pointer;
        }

        input[type="checkbox"] {
            -webkit-appearance: none; /* Remove default appearance */
            -moz-appearance: none;
            background-color: white; /* Background color when checked */

            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ccc; /* Default border color */
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }
        /* Custom checkbox when checked */
        input[type="checkbox"]:checked {
            background-color: orange; /* Background color when checked */
            border-color: red; /* Border color when checked */
        }
        /* Custom checkbox when checked - checkmark */
        input[type="checkbox"]:checked::after {
            content: "\2713"; /* Checkmark symbol */
            color: white; /* Color of the checkmark */
            font-size: 14px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endsection

<section>
    {{-- <h1 class="module inter">User Management</h1> --}}

    <div class="header">
        <form action="" class="search-form">
            <input type="text" class="search-form__input inter" placeholder="Search User">
            <button type="submit" class="search-form__button inter">Search</button>
        </form>

        <button class="btn">Add User</button>
    </div>

    <table class="table">
        <thead>
            <th><input type="checkbox" name="" id=""></th>
            <th>Name</th>
            <th>Employee Id</th>
            <th>Email Address</th>
            <th>Location</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <input id="terms" type="checkbox" value=""
                            class="w-4 
                            h-4 
                            text-orange-500
                            border 
                            border-gray-300 
                            rounded bg-gray-50 
                            focus:ring-3 
                            focus:ring-blue-300 
                            dark:bg-gray-700 
                            dark:border-gray-600 
                            dark:focus:ring-blue-600 
                            dark:ring-offset-gray-800 
                            dark:focus:ring-offset-gray-800"
                            required />
                        </div>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->employee_id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->location }}</td>
                    <td>Admin</td>
                    <td>Active</td>
                    <td>
                        <button>Edit</button>
                        <button>View</button>

                    </td>

                </tr>
            @endforeach
        </tbody>


    </table>
    {{ $users->links() }}
</section>
