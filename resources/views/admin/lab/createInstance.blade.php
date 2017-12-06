<div class="modal fade" id="createInstanceModal" tabindex="-1" role="dialog" aria-labelledby="createInstanceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createInstanceModal"><i class="fa fa-plus-square"></i>กำหนด Instance</h4>
            </div>
            <form action="{{ route('admin.lab.createInstance', $lab->id) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group required">
                        <label>ชื่อ Instance</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group required">
                        <label>เลือก Images</label>
                        <select class="form-control" name="imageId">
                            <option value="" disabled selected>เลือก Images</option>
                            @foreach($images as $image)
                            <option value="{{ $image->id }}">{{ $image->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label>เลือกเทมเพลตสำหรับสร้าง Instance</label>
                        <select class="form-control" name="flavorId">
                            <option value="" disabled selected>เลือกเทมเพลตสำหรับสร้าง Instance</option>
                            @foreach($flavors as $flavor)
                                <option value="{{ $flavor->id }}">{{ $flavor->name }} (vCPUs {{ $flavor->vcpus }}, Disk {{ $flavor->disk }} GB., RAM {{ $flavor->ram }} MB., SWAP {{ $flavor->swap | 0 }} MB.)</option>
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