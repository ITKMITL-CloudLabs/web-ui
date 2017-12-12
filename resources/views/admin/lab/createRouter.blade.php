<div class="modal fade" id="createRouterModal" tabindex="-1" role="dialog" aria-labelledby="createRouterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createRouterModal"><i class="fa fa-plus-square"></i>สร้าง Router</h4>
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
                            <option value="e3bac3f3-1fec-4e59-993c-7b0d1a1964e0">Public</option>
                            @foreach($networks as $network)
                                <option value="{{ $network->id }}">{{ $network->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>