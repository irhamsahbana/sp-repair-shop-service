@extends('App')

@section('content-header', 'Daftar Order Perbaikan')

@section('content')
<x-content>
    <x-row>
        <x-card-collapsible>
            <x-row>
                <x-col class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                </x-col>
            
                <x-col>
                    <x-table :thead="['Customer ID', 'Tanggal Penerimaan', 'Tanggal Perkiraan Selesai', 'Status', 'Total Biaya', 'Aksi']">
                        @foreach ($repair_orders as $repair_order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $repair_order->customer_id }}</td>
                                <td>{{ $repair_order->date_received }}</td>
                                <td>{{ $repair_order->estimated_completion_waktu }}</td>
                                <td>{{ $repair_order->status }}</td>
                                <td>{{ $repair_order->total_cost }}</td>
                                <td>
                                    <a
                                    href="{{ route('repair_order.show', $repair_order->id) }}"
                                    class="btn btn-warning"
                                    title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                    <form style=" display:inline!important;" method="POST" action="{{ route('repair_order.destroy', $repair_order->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </x-col>
            </x-row>
        </x-card-collapsible>
    </x-row>
</x-content>

<x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'xl'">
    <form style="width: 100%" action="{{ route('repair_order.store') }}" method="POST">
        @csrf
        @method('POST')
        <!-- belum selesai -->
        <x-row>
            <x-in-text col="2" :label="'Customer ID'" :id="'customer_id'" :name="'customer_id'" :required="true" />
            <!-- <x-in-text col="4" :label="'Date'" :id="'date'" :name="'date'" :required="true" /> -->
            <input type="date" name="date_received" id="date_received" class="form-control" required>
            <input type="date" name="estimated_completion_waktu" id="estimated_completion_waktu" class="form-control" required>
            <x-in-text col="4" :label="'Status'" :id="'status'" :name="'status'" :required="true" />
            <x-in-text col="4" :label="'Total Biaya'" :id="'total_cost'" :name="'total_cost'" :required="true" />
        </x-row>
        
        <x-col class="text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-col>
    </form>
</x-modal>
@endsection