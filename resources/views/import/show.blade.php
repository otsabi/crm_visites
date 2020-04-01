@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{asset('theme/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
    td.details-control {
    background: url('https://www.pngitem.com/pimgs/m/112-1121197_ios-add-icon-green-hd-png-download.png') no-repeat center center;
    cursor: pointer;
}
tr.details td.details-control {
    background: url('../resources/details_close.png') no-repeat center center;
}
    </style>
@endpush

@section('content')

    <div class="row">

        <div class="col-sm-12">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    Well done ! -  {{session('status')}}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6>Oops ! </h6>
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    </div>


    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <i class="mdi mdi-account-group"></i>&nbsp; Rapport Med
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Date de visite</th>
                                <th>Nom_Prenom</th>
                                <th>Plan/Réalisé</th>
                                <th>Potentiel</th>
                                <th>Etablissement</th>
                                <th>DELEGUE</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>



@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Produits : <span></span> </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Etes-vous sûr que vous voulez supprimer ce Produit ?</h6>
                    <form action="" method="post" id="delete_form">
                        @csrf
                        @method('delete')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="document.getElementById('delete_form').submit()" type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!--<script type="text/javascript" src="{{asset('theme/vendors/datatables.net/jquery.dataTables.js')}}"></script>-->
    <!--<script src="{{asset('theme/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script src="{{asset('theme/js/data-table.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#deleteModel').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) ;// Button that triggered the modal
                var produit_id = button.data('whatever'); // Extract info from data-* attributes
                var code_libelle = button.data('produit'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('.modal-body>form').attr('action','/admin/products/'+produit_id);
                modal.find('.modal-title>span').text(code_libelle);

            })
        });
    </script>
    <script>

        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>P1 Présenté:</td>'+
                '<td>'+d.P1_présenté+'</td>'+
               
                '<td>P1 Feedback:</td>'+
                '<td>'+d.P1_Feedback+'</td>'+
              
                '<td>P1 Ech:</td>'+
                '<td>'+d.P1_Ech+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>P2 Présenté:</td>'+
                '<td>'+d.P2_présenté+'</td>'+
               
                '<td>P2 Feedback:</td>'+
                '<td>'+d.P2_Feedback+'</td>'+
                
                '<td>P2 Ech:</td>'+
                '<td>'+d.P2_Ech+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>P3 Présenté:</td>'+
                '<td>'+d.P3_présenté+'</td>'+
               
                '<td>P3 Feedback:</td>'+
                '<td>'+d.P3_Feedback+'</td>'+
               
                '<td>P3 Ech:</td>'+
                '<td>'+d.P3_Ech+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>P4 Présenté:</td>'+
                '<td>'+d.P4_présenté+'</td>'+
               
                '<td>P4 Feedback:</td>'+
                '<td>'+d.P4_Feedback+'</td>'+
                
                '<td>P4 Ech:</td>'+
                '<td>'+d.P4_Ech+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>P5 Présenté:</td>'+
                '<td>'+d.P5_présenté+'</td>'+
              
                '<td>P5 Feedback:</td>'+
                '<td>'+d.P5_Feedback+'</td>'+
              
                '<td>P5 Ech:</td>'+
                '<td>'+d.P5_Ech+'</td>'+
                '</tr>'+
                '</table>';
        }
        
        $(document).ready(function() {
            var table = $('#example').DataTable({
                //dataRapportMed
                 "ajax": {
                  "url": "dataRapportMed",
                    "dataSrc": ""
                },
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    {"data": "Date_de_visite" },
                    {"data": "Nom_Prenom" },
                    {"data": "Plan/Réalisé" },
                    {"data": "Potentiel" },
                    {"data": "Etablissement" },
                    {"data": "DELEGUE" }
                ]
              
                
            } );

            // Add event listener for opening and closing details
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        } );
    </script>
@endpush
