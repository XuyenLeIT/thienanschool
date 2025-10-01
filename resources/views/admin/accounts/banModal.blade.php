<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="banForm" method="POST" action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Chọn lý do ban:</p>
                    @php
                        $reasons = ['Vi phạm nội quy','Lạm quyền','Không hoàn thành công việc','Hành vi không phù hợp','Khác'];
                    @endphp
                    @foreach ($reasons as $reason)
                        <div class="form-check">
                            <input class="form-check-input reason-radio" type="radio" name="reason"
                                   id="reason{{ $loop->index }}" value="{{ $reason }}">
                            <label class="form-check-label" for="reason{{ $loop->index }}">{{ $reason }}</label>
                        </div>
                    @endforeach
                    <div class="mt-2" id="otherReasonDiv" style="display:none;">
                        <input type="text" class="form-control" name="other_reason" placeholder="Nhập lý do khác">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                </div>
            </div>
        </form>
    </div>
</div>
