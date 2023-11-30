<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td><img src="{{$category->image}}" style="width:50px; height:50px;"></td>
                                        <td>{{ $category->user_id }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td><button type="button" class="btn btn-primary" onclick="editBtn('{{$category->id}}')">Edit</button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href='/deleteItem?id={{$category->id}}'">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" id="addCategory">
                            <form method="POST" action="{{ route('AllCat') }}" enctype="multipart/form-data">
                                @csrf <!-- CSRF Protection -->
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" required>
                                    <label for="category_name" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/jpeg, image/png" required>

                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                        
                        <div class="card" id="editCategory" style="display:none;">
                            <form method="POST" action="{{ route('edit') }}" enctype="multipart/form-data">
                                @csrf <!-- CSRF Protection -->
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" required>
                                    <label for="category_name" class="form-label">Upload Image</label>
                                    <input type="hidden" id="idGet" name="id">
                                    <input type="file" class="form-control" name="image" accept="image/jpeg, image/png" required>

                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-primary" onclick="cancelBtn()">Cancel</button>
                            </form>
                        </div>

                       
                    </div>

                    
                </div>
            </div>

<br><br>


            <div class="container">
     
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                        <span style="text-align:center; font-size:20px;">Deleted Data</span>
                        <br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Deleted At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($retrieve as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td><img src="{{$category->image}}" style="width:50px; height:50px;"></td>
                                        <td>{{ $category->user_id }}</td>
                                        <td>{{ $category->deleted_at }}</td>
                                        <td><button type="button" class="btn btn-primary" onclick="window.location.href='/retrieve?id={{$category->id}}'">Retrieve</button>
                                       
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                    
                </div>
            </div>
        </div>
    </div>

    <script>

        function editBtn(id){
            document.getElementById('idGet').value = id;
            document.getElementById('addCategory').style.display = "none";
            document.getElementById('editCategory').style.display = "block";
        }

        function cancelBtn(){
            document.getElementById('addCategory').style.display = "block";
            document.getElementById('editCategory').style.display = "none";
        }
    </script>
</x-app-layout>