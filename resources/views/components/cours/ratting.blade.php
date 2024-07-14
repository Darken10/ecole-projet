
    <div class="container">

        <!-- Vérification si l'utilisateur a déjà noté le post -->
        @if (!Auth::user()->hasRated($lesson))
            <!-- Boîte modale pour la notation -->
            <div id="ratingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ratingModalLabel">Noter ce post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire de notation -->
                            <form action="#" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rating">Votre note (entre 1 et 5)</label>
                                    <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Soumettre</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Script pour afficher automatiquement la modal si l'utilisateur n'a pas noté -->
    @if (!Auth::user()->hasRated($lesson))
        <script>
            $(document).ready(function() {
                $('#ratingModal').modal('show');
            });
        </script>
    @endif

