@props(['matiere'])

<section id="demos">
  <div class="row">
    <div class="large-12 columns">       
      <div class="nonloop owl-carousel">
        @foreach ($matiere->lessons as $lesson)
          @if ($lesson->is_published())
            <x-cours.accordeon-cours-item :$lesson />
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>

