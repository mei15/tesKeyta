@extends('layouts.app')

@section ('content')
<body>
	<div class="row">
		<div class="container">

			
			<div class="col-lg-8 mx-auto my-5">	

				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif

				<form action="/upload/proses" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<b>File Gambar</b><br/>
						<input type="file" name="image">
					</div>

					<div class="form-group">
						<b>Nama</b>
						<textarea class="form-control" name="name"></textarea>
					</div>

                    <div class="form-group">
						<b>Brand</b>
						<textarea class="form-control" name="brand"></textarea>
					</div>

                    <div class="form-group">
						<b>Harga</b>
						<textarea class="form-control" name="price"></textarea>
					</div>

                    <div class="form-group">
                    <div>
                        <select name="gender" id="gender" class="form-control">
                            <option selected="true" value="" disabled hidden>Pilih Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Unisex">Unisex</option>
                        </select>
                    </div>
					</div>

                    <div class="form-group">
						<b>Kategori</b>
						<textarea class="form-control" name="category"></textarea>
					</div>

                    <div class="form-group">
						<b>Kuantitas</b>
						<textarea class="form-control" name="quantity"></textarea>
					</div>


					<input type="submit" value="Upload" class="btn btn-primary">
				</form>
				
				<h4 class="my-5">Data</h4>

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="1%">Image</th>
							<th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Gender</th>
                            <th>Category</th>
                            <th>Quantity</th>
							<th width="1%">OPSI</th>
						</tr>
					</thead>
					<tbody>
						@foreach($produk as $p)
						<tr>
							<td><img width="150px" src="{{ url('/data_file/'.$p->image) }}"></td>
							<td>{{$p->name}}</td>
                            <td>{{$p->brand}}</td>
                            <td>{{$p->price}}</td>
                            <td>{{$p->gender}}</td>
                            <td>{{$p->category}}</td>
                            <td>{{$p->quantity}}</td>
							<td><a class="btn btn-danger" href="/upload/hapus/{{ $p->id }}">HAPUS</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
@endsection