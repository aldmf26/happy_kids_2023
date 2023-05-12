
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">
        Detail Pasien  
    </h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
      <i data-feather="x"></i>
    </button>
  </div>
<div class="modal-body">
    <table class="table table-md">
        @foreach ($datas as $d)
            
        <tr>
            <td>No Order </td>
            <td>:</td>
            <td width="70%">{{ $d->no_order }}</td>
            
        </tr>
        @endforeach
        
    </table>

</div>