@php
    $r = 0;
@endphp
@foreach ($chat as $a)
    @php
        $count = $r++;
    @endphp
@endforeach
@if (empty($count))
    <h3>Terimakasih Sudah Menjawab Semua Pertanyaan</h3>
    <center>
        <a href="{{ route('cetak', ['no_order' => $no_order, 'member_id' => $member_id]) }}" class="btn btn-warning"><i
                class="fas fa-print"></i>
            Cetak</a>
    </center>
@else
    <h2 class="font-normal">M-CHAT-R (Modified Checklist for Autism in Toddlers, Revised)</h2>

    <form id="save_per4">
        <input type="hidden" class="no_order" name="no_order" value="{{ $no_order }}">
        <input type="hidden" class="member_id" name="member_id" value="{{ $member_id }}">
        <!-- Step 2 input fields -->
        <div class="mt-3">
            <p>Mohon jawab pertanyaan berikut ini tentang anak anda. Pikirkan bagaimana perilaku anak anda
                biasanya. Jika pernah melihat anak anda melakukan tindakan itu beberapa kali, namun dia tidak
                selalu melakukannya, maka jawab tidak. Tolong pilih <b>ya</b> atau <b>tidak</b> pada setiap
                pertanyaan. Terima Kasih</p>

            <div class="row">
                <div class="col-lg-12">
                    <table width="100%">
                        @php
                            $no = 1;
                            $ya = 1;
                            $tdk = 1;
                        @endphp
                        @foreach ($chat as $key => $c)
                            @php
                                $jawaban = DB::selectOne("SELECT b.id_pertanyaan,b.jawaban4
                                                        FROM jawaban4 AS b 
                                                        WHERE b.no_order='$no_order' AND b.member_id='$member_id' and b.id_pertanyaan = '$c->id_pertanyaan'");
                            @endphp
                            <tr>
                                <td style="vertical-align: top;">{{ $chat->firstItem() + $key }}.</td>
                                <td>{{ $c->pertanyaan }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="radio" name="jawaban[]{{ $ya++ }}" id=""
                                        value="Ya" required
                                        {{ (empty($jawaban->jawaban4) ? '' : $jawaban->jawaban4 == 'Ya') ? 'checked ' : '' }}>
                                    <span class="text-primary">Ya</span>
                                    <input type="radio" name="jawaban[]{{ $tdk++ }}" id=""
                                        value="Tidak" required
                                        {{ (empty($jawaban->jawaban4) ? '' : $jawaban->jawaban4 == 'Tidak') ? 'checked ' : '' }}>
                                    <span class="text-primary">Tidak</span>
                                    <input type="hidden" name="id_pertanyaan[]" value="{{ $c->id_pertanyaan }}">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-lg-12">
                    <div style="float: right">
                        {{-- {{ $chat->links() }} --}}
                        <a class="btn btn-primary bpage"><i class="fas fa-chevron-left"></i> Prev</a>
                        <button type="submit" class="btn btn-primary ">Next <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>



            </div>

        </div>
    </form>
@endif
<div class="row">
    <div class="col-lg-12">
        <hr>
        <div class="mt-3">
            <button class="btn btn-primary back3" type="button" step_number="3">Prev</button>
        </div>
    </div>
</div>
