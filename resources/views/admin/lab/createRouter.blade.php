<div class="modal fade" id="createRouterModal" tabindex="-1" role="dialog" aria-labelledby="createRouterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createRouterModal">สร้าง Router</h4>
            </div>
            <form action="{{ route('admin.lab.createRouter', $lab->id) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่อ Router</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>เลือก Network</label>
                        <select class="form-control" name="networkId">
                            <option value="" disabled selected>เลือก Network</option>
                            <option value="{{ env('OS_PUBLIC_NETWORK_ID') }}">Public</option>
                            @foreach($networks as $network)
                                <option value="{{ $network->id }}">{{ $network->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>