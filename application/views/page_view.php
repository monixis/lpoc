
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Requester Name</th>
        <th>Event Name</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $offset = $this->uri->segment(3, 0) + 1; ?>
    <?php foreach ($query->result() as $row): ?>
        <tr>
            <td><a target="_blank" href="<?php echo base_url("?c=lpoc&m=reviewRequest&requestID=").$row->requestID?>"><?php echo $row ->requestID ?></a></td>
            <td><?php echo $row->requesterName; ?></td>
            <td><?php echo $row->eventName; ?></td>
            <td><?php if($row->status == 1){ ?>
                    Submitted
                <?php } else if($row->status == 2){ ?>
                    Returned
                <?php } else if($row->status == 3){ ?>
                    Approved
                <?php } ?>
            </td>
            <td><?php echo $row->updatedate; ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div align="right" id="NumRecords">
    <label class="label" for="collection">Total:<?php echo $total_rows?></label>
</div>
<nav class='text-center'>
    <?php echo $pagination_links; ?>

</nav>
