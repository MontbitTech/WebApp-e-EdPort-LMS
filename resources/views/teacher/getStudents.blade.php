<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle1">Student List</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body pt-4">
    <input type="hidden" name="txt_class_id" id="txt_class_id">
    <input type="hidden" id="txt_section_id" name="txt_section_id">
    <div class="col-sm-12">

        <?php if (count($students) > 0) { ?>
            <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $i = 0;
                    foreach ($students as $row) {
                    ?>

                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                        </tr>

                    <?php
                    }
                    $i++;
                } else {
                    ?>
                    <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                        <svg class="icon icon-4x mr-3">
                            <use xlink:href="../images/icons.svg#icon_nodate"></use>
                        </svg>
                        No Record Found!
                    </div>
                <?php
                }
                ?>
                </tbody>
            </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#teacherlist').DataTable();
    });
</script>