<!-- Waste History Details -->
<div class="modal fade" id="waste_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Waste History Details for <span class="names"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Waste Type</th>
                            <th>Waste Weight</th>
                            <th>Gained Points</th>
                            <th>Penalized Points</th>
                            <th>Feedback for Improvement</th>
                            <th>Total Points</th>
                        </tr>
                    </thead>
                    <tbody id="hist_body"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <a href='sell_waste.php' class='btn btn-success btn-lg'><i class='fa fa-first-order'></i> View Waste History</a>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content {
        font-family: 'Raleway', sans-serif;
    }

    .modal-title,
    .close {
        color: #333;
        font-size: 1.5rem;
    }

    .modal-body,
    .modal-footer {
        padding: 20px;
    }

    .modal-footer {
        background-color: #f8f9fa;
    }

    .table {
        margin-bottom: 0;
        text-align: center;
    }
</style>