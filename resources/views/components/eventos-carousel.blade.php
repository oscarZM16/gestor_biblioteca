<div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel" style="max-width: 600px; margin: auto;">
  <div class="carousel-inner rounded shadow-sm">
    @forelse ($eventos as $key => $evento)
      <div class="carousel-item @if($key == 0) active @endif">
        <a href="{{ route('eventos.show', $evento->id) }}" style="text-decoration: none; color: inherit;">
          <img src="{{ asset('storage/' . $evento->imagen) }}"
               class="d-block w-100"
               alt="{{ $evento->titulo }}"
               style="max-height: 250px; object-fit: cover;">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded px-2">
            <h6 class="mb-1">{{ $evento->titulo }}</h6>
            <p class="small mb-0">{{ Str::limit($evento->descripcion, 100) }}</p>
          </div>
        </a>
      </div>
    @empty
      <div class="carousel-item active">
        <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height: 250px;">
          <h6>No hay eventos disponibles</h6>
        </div>
      </div>
    @endforelse
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
