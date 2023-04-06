@php
    $layout = (auth()->user()->tipo == "administrador") ? 'layouts.sidebar-admin' : 'layouts.sidebar-empleado';
@endphp
@extends($layout)
@section('contenido')
<h2>Gestion de certificaciones</h2>
@auth
    <div>
        <a class="btn btn-success" href="{{route('certificacion.create')}}">Agregar certificacion +</a>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>INSTITUCION</th>
            <th>FECHA COMIENZO</th>
            <th>FECHA FIN</th>
            <th>TIPO</th>
            <th>ARCHIVO</th>
            <th>OPCIONES</th>
        </thead>
        <tbody>
            @foreach ($certificaciones as $certif)
                <tr>
                    <td>{{$certif->idCertificaciones}}</td>
                    <td>{{$certif->nombre}}</td>
                    <td>{{$certif->institucion}}</td>
                    <td>{{$certif->fechacomienzo}}</td>
                    <td>{{$certif->fechafin}}</td>
                    <td>{{$certif->tipo}}</td>
                    <td>{{$certif->archivo}}</td>
                    <td class="btn-group">
                        <a class="btn btn-primary bi-eye" href="{{route('certificacion.show',$certif->idCertificaciones)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>
                        <a class="btn btn-warning" href="{{route('certificacion.edit',$certif->idCertificaciones)}}">
                            <i class="fas fa-edit text-white"></i>
                        </a>
                        <form action="{{route('certificacion.destroy',$certif->idCertificaciones)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('descargar.archivo', $certif->idCertificaciones) }}" class="btn btn-primary">
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endauth
@guest
    <h1>Homepage</h1>
    <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
@endguest
<script>
 const tipo = '{{ auth()->user()->tipo }}';
        if (tipo === "administrador") {
            valor = 6;
        } else {
            valor = 4;
        }
        const list = document.getElementsByTagName("LI")[valor];
        list.className += " active";
</script>
@endsection
