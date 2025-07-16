<!-- Correspondence Detail Modal -->
<div class="modal fade" id="correspondenceDetailModal" tabindex="-1" aria-labelledby="correspondenceDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="correspondenceDetailModalLabel">Correspondence Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="correspondenceDetailContent">
                Loading...
            </div>
        </div>
    </div>
</div>

<script>
    var correspondenceDetailsUrl = @json(route('correspondence-movements.correspondence-details', ['id' => 'CORRESPONDENCE_ID_PLACEHOLDER']));

    $(document).on('click', '.correspondence-id', function() {
        var correspondenceId = $(this).data('id');
        var url = correspondenceDetailsUrl.replace('CORRESPONDENCE_ID_PLACEHOLDER', correspondenceId);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#correspondenceDetailContent').html(data);
                $('#correspondenceDetailModal').modal('show');
            },
            error: function() {
                $('#correspondenceDetailContent').html('<p class="text-danger">Unable to load correspondence details.</p>');
                $('#correspondenceDetailModal').modal('show');
            }
        });
    });
</script>
