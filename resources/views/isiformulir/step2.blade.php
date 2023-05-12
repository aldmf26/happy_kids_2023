<h2 class="font-normal">KPSP Pada Anak</h2>
<!-- Step 2 input fields -->
<form id="save_per2">
    <input type="hidden" class="no_order" name="no_order" value="{{ $no_order }}">
    <input type="hidden" class="member_id" name="member_id" value="{{ $member_id }}">
    <div class="mt-3">
        <table class="table table-bordered" style="color: #787878">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th></th>
                    <th>Ya</th>
                    <th>Tidak</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $ya = 1;
                    $tdk = 1;
                @endphp
                @foreach ($kel_kpsp as $k)
                    @php
                        $kpsp = DB::select("SELECT * FROM pertanyaan as a left join kelompok_gerak as b on b.id_gerak = a.id_gerak where a.kelompok_pertanyaan = '2' and id_kel_kpsp = $k->id_kel_kpsp");
                    @endphp
                    <tr>
                        <th colspan="2">{{ $k->nm_kpsp }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                    @foreach ($kpsp as $p)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $p->pertanyaan }}
                            </td>
                            @php
                                if ($p->id_gerak == '1') {
                                    $warna = 'bg-primary text-white';
                                } elseif ($p->id_gerak == '2') {
                                    $warna = 'bg-success text-white';
                                } elseif ($p->id_gerak == '3') {
                                    $warna = 'bg-warning text-white';
                                } else {
                                    $warna = 'bg-danger text-white';
                                }
                            @endphp

                            <td style="vertical-align: middle;" class="{{ $warna }}">
                                {{ $p->nm_gerak }}</td>
                            <td style="vertical-align: middle; text-align: center"><input type="radio"
                                    name="jawaban[]{{ $ya++ }}" id="" value="Ya" required>
                            </td>
                            <td style="vertical-align: middle; text-align: center"><input type="radio"
                                    name="jawaban[]{{ $tdk++ }}" id="" value="Tidak" required>
                            </td>
                            <input type="hidden" value="{{ $p->id_pertanyaan }}" name="id_pertanyaan[]">
                        </tr>
                    @endforeach
                @endforeach



            </tbody>



        </table>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary back1" type="button" step_number="1">Prev</button>
        <button class="btn btn-primary next3" type="submit" step_number="3">Next</button>
    </div>
</form>
