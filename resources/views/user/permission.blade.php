<input type="hidden" name="kd_user" value="<?= $id_user ?>">
<table class="table ">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Sub Menu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Menu Dashboard</td>
            <td>
                @foreach ($dashboard as $v)
                    <label for="labdb{{ $v->id }}">{{ $v->teks }}</label>
                    <br>
                @endforeach
            </td>
            <td>
                
                @foreach ($dashboard as $v)
                @php
                    $menu_dashboard = DB::table('dashboard_permission')
                            ->where('id_menu_dashboard', $v->id)
                            ->where('id_user', $id_user)
                            ->first()
                @endphp
                    @if (empty($menu_dashboard->id_menu_dashboard))
                        <input type="checkbox" name="id_menu_dashboard[]" value="{{ $v->id }}" id="labdb{{$v->id}}"><br>
                    @else
                        <input type="checkbox" name="id_menu_dashboard[]" value="{{ $v->id }}" id="labdb{{$v->id}}" checked><br>
                    @endif
                @endforeach
                
            </td>
            
        </tr>
        <?php foreach ($menu as $m) : ?>

        <tr>
            <td style="vertical-align: middle;">
                <?= $m->menu ?>
                
                
            </td>
            <td>
                <?php $sub = DB::table('tb_sub_menu')
                ->where('id_menu', $m->id_menu)
                ->get() ?>
                <?php foreach ($sub as $s) : ?>
                <label for="labm{{ $s->id_sub_menu }}">{{$s->sub_menu}}</label>
                <br>
                <?php endforeach ?>
            </td>
            <td>
                <?php foreach ($sub as $s) : ?>

                <?php $menu_p = DB::table('tb_permission')
                ->where('permission', $s->id_sub_menu)
                ->where('id_user', $id_user)
                ->first() ?>

                <?php if (empty($menu_p->permission)) : ?>
                <input type="checkbox" name="permission[]" value="<?= $s->id_sub_menu ?>" id="labm{{ $s->id_sub_menu }}"><br>
                <?php else : ?>
                <input type="checkbox" name="permission[]" value="<?= $s->id_sub_menu ?>" id="labm{{ $s->id_sub_menu }}" checked><br>
                <?php endif ?>

                <?php endforeach ?>
            </td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td>Menu Void</td>
            <td>
                @foreach ($void as $v)
                    <label for="labvoid{{ $v->id }}">{{ $v->teks }}</label>
                    <br>
                @endforeach
            </td>
            <td>
                
                @foreach ($void as $v)
                @php
                    $menu_void = DB::table('void_permission')
                            ->where('id_menu_void', $v->id)
                            ->where('id_user', $id_user)
                            ->first()
                @endphp
                    @if (empty($menu_void->id_menu_void))
                        <input type="checkbox" name="id_menu_void[]" value="{{ $v->id }}" id="labvoid{{$v->id}}"><br>
                    @else
                        <input type="checkbox" name="id_menu_void[]" value="{{ $v->id }}" id="labvoid{{$v->id}}" checked><br>
                    @endif
                @endforeach
                
            </td>
            
        </tr>
    </tbody>

</table>