<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">
            Detail Saldo Pasien : <b>{{ $nama }}</b>
        </h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <tr>
                        <th>Therapist</th>
                        <th>Paket</th>
                        <th width="20%">Dipakai</th>
                    </tr>
                    @foreach ($invoice_kunjungan as $i)
                    <tr>
                        <td>{{ $i->nama_therapy }}</td>
                        <td>{{ $i->nama_paket }}</td>
                        <td>{{ $i->kredit }}</td>
                    </tr>
                    @endforeach
                    {{-- @php
                    $debit = 0;
                    $kredit = 0;
                    @endphp
                    @foreach ($invoice_kunjungan as $i)
                    @php
                    $debit = $i->debit;
                    $kredit = $i->kredit;
                    $ttl = $i->debit - $i->kredit;
                    @endphp
                    @if ($ttl > 0)
                    <tr>
                        <td>
                            {{$i->nama_therapy}}
                            <input type="hidden" name="id_therapist[]" value="{{$i->id_therapist}}">
                        </td>
                        <td>
                            {{$i->nama_paket}}
                            <input type="hidden" name="id_paket[]" value="{{$i->id_paket}}">
                        </td>
                        <td>{{$debit}}</td>
                        <td>{{$kredit}}</td>
                    </tr>
                    @endif

                    @endforeach --}}
                </table>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>
    </div>

</div>