<div id="ajax_response_div">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>اسم الخزنة</th>
                    <th>نوع الخزنة</th>
                    <th>حالة التفعيل</th>
                    <th>اخر ايصال صرف</th>
                    <th>اخر ايصال تفحصيل</th>
                    <th width="20%">التحكم</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($ajax_search as $search)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $search->name }}</td>
                    <td>{{ $search->is_master ? 'رئيسية' : 'فرعية' }}</td>
                    <td>{!! $search->active()!!}</td>
                    <td>{{ $search->last_receipt_exchange}}</td>
                    <td>{{ $search->last_receipt_collect}}</td>
                    <td>
                        <a href="{{ route('backend.treasuries.edit',$search->id) }}" class="btn btn-primary btn-sm"
                            data-id="{{ $search->id }}">
                            <i class='bx bx-edit'></i>
                        </a>

                        <a href="{{ route('backend.treasuries.show',$search->id) }}" class="btn btn-info btn-sm"
                            data-id="{{ $search->id }}">
                            <i class='bx bx-show-alt'></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-danger">لايوجد بيانات متاحة حاليا</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot class="table-border-bottom-0">
                <tr>
                    <div>
                        <td colspan="8">
                            <div id="search_ajax_pagination"> {{ $ajax_search->links() }}</div>
                        </td>
                    </div>
                </tr>
            </tfoot>
        </table>
    </div>
    {{-- /.table-responsive --}}
</div>
{{-- /#ajax_response_div --}}