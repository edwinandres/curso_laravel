@extends("layouts.plantilla")

@section("cabecera")
  <h1>Galeria</h1>
@endsection

@section("informacionGeneral")
  <h1>Aqui esta el contenido principal de la pagina</h1>
  @if(count($galeria))
    <table class="" width="50%" border="1">
      @foreach($galeria as $persona)
        <tr>
          <td>
           {{$persona}}
          </td>
        </tr>       
      @endforeach
    </table>
  @else
    {{'Sin alumnos'}}
  @endif
@endsection

@section("pieDePagina")
  <h1>Aqui va el pie de pagina</h1>
@endsection