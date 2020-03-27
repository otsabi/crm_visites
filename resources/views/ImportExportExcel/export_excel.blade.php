


<html>
 <head>
  <title>Export Data to Excel in Laravel using Maatwebsite</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>

  <br />
  <div class="container">


  <h3 align="center">Exporter les données au format Excel</h3><br />
   <div align="center">
    <a href="{{ route('exportexcel') }}" class="btn btn-success">Exporter Vers Excel</a>
   </div>
   <br />



  <div class="table-responsive">
   

   <!-- //Table show visites data -->
    <table class="table table-striped table-bordered" id="myTable">
     <thead>
      <th>Nom
      <th>Prenom
      <th>Etablissement
      <th>Potentiel
      <th>Date Visite
      <th>Specialite
      <th>Ville
      <th>Libelle P1
      <th>Feedback P1
      <th>Libelle P2
      <th>Feedback P2
      <th>Libelle P3
      <th>Feedback P3
      <th>Libelle P4
      <th>Feedback P4
      <th>Libelle P5
      <th>Feedback P5
      
     </thead>
      <tboody>
      <?php
      use App\Exports\VisitesExport;
     $datas = new VisitesExport;
      $visites = $datas->collection();
?>

    <!-- //Get Visites data from Class VisitesExport -->
      @foreach($visites as $visite)
      <tr>
      <td> {{ $visite->nom }} </td>
      <td> {{ $visite->prenom }} </td>
      <td> {{ $visite->etablissement }} </td>
      <td> {{ $visite->potentiel }} </td>
      <td> {{ $visite->date_visite }} </td>
      <td> {{ $visite->specialite }} </td>
      <td> {{ $visite->ville }} </td>
      
      <?php
      if(isset($visite->produit1)){
        ?>
        <td>{{ $visite->produit1 }}
        <?php }else{
        ?>
        <td></td>
        <?php }

        
      if(isset($visite->feedback1)){
        ?>
        <td>{{ $visite->feedback1 }}</td>
      <?php }else{
        ?>
        <td></td>
        <?php }

      
      if(isset($visite->produit2)){
        ?>
        <td>{{ $visite->produit2 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }

        
      if(isset($visite->feedback2)){
        ?>
        <td>{{ $visite->feedback2 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
      
      if(isset($visite->produit3)){
        ?>
        <td>{{ $visite->produit3 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
        
      if(isset($visite->feedback3)){
        ?>
        <td>{{ $visite->feedback3 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
      
      if(isset($visite->produit4)){
        ?>
        <td>{{ $visite->produit4 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
        

      if(isset($visite->feedback4)){
        ?>
        <td>{{ $visite->feedback4 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
      
      if(isset($visite->produit5)){
        ?>
        <td>{{ $visite->produit5 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
        
      if(isset($visite->feedback5)){
        ?>
        <td>{{ $visite->feedback5 }}</td>
        <?php }else{
        ?>
        <td></td>
        <?php }
        ?>
      </tr>
      @endforeach
      </tbody>
    </table>
    

  
   
  </div>
 </body>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
  </script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js">
</script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script type="text/javascript" src="jquery.dataTables.js"></script>



 
</html>