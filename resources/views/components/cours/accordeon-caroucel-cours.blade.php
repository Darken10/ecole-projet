@props(['matiere'])

<section id="demos">
  <div class="row">
    <div class="large-12 columns">       
      <div class="nonloop owl-carousel">
        @foreach ($matiere->chapitres as $chapitre)
          @if ($chapitre->has_lessons_published())
            <x-cours.accordeon-cours-item :$chapitre />
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>

