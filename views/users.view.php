<?php if (!defined("NO_DIRECT")) die("Direct Access is not allowed"); ?>
<div class="inner-content" id="main-wrapper">
    <h3>User Manager</h3>
    <div>Edit,Delete,Enable and disable users.</div>
    <div class="button-container">
        <div><a href="index.php?q=user&action=edit" class="savebutton">Add New</a></div>
    </div>
    <?php include 'messages.view.php'; ?>
    <div class="form-container">

        <table class="data-table" width="100%" id="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th> Username</th>
                    <th>Email</th>
                    <th> Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="ucase">
                <?php foreach ($rows as $k => $row): ?>
                    <tr class="<?php echo ($k % 2 == 0) ? "odd" : "even"; ?>" id="<?php echo $row->id; ?>-row">
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><input type="checkbox" value="<?php echo $row->id; ?>" name="status" id="status_<?php echo $row->id; ?>" <?php echo ($row->status) ? ' CHECKED="checked"' : ''; ?>/></td>
                        <td><a class="savebutton edBtn" href="index.php?q=user&action=edit&id=<?php echo $row->id; ?>">Edit</a><a class="savebutton delBtn"  href="index.php?q=user&action=delete&id=<?php echo $row->id; ?>" onclick="javasript:return confirm('Are you sure you want to delete this user?')">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <a href="#" class="first" data-action="first">&laquo;</a>
        <a href="#" class="previous" data-action="previous">&lsaquo;</a>
        <input type="text" readonly="readonly" data-max-page="<?php echo $num_pages; ?>" />
        <a href="#" class="next" data-action="next">&rsaquo;</a>
        <a href="#" class="last" data-action="last">&raquo;</a>
    </div>
</div>
<script>
                            $(document).ready(function() {
                                $(document).on('click', "input[id*='status_']", function() {
                                    document.location = "index.php?q=user&action=status&id=" + $(this).val();
                                });

                                $('.pagination').jqPagination({
                                    paged: function(page) {
                                        $.getJSON("index.php?q=user&action=ajax", {page: page}, function(data) {
                                            if (data.success)
                                            {
                                                $("#user-table tbody tr").remove();
                                                for (x in data.values)
                                                {

                                                    var tr = $("<tr></tr>");
                                                    var name = $("<td></td>");
                                                    var username = $("<td></td>");
                                                    var email = $("<td></td>");
                                                    var status = $("<td></td>");
                                                    var actions = $("<td></td>");
                                                    name.text(data.values[x].name);
                                                    username.text(data.values[x].username);
                                                    email.text(data.values[x].email);

                                                    status.html('<input type="checkbox" value="' + data.values[x].id + '" name="status" id="status_' + data.values[x].id + '"/>');
                                                    if (data.values[x].status == "1")
                                                        $("input", status).prop('checked', true);

                                                    actions.html('<a class="savebutton edBtn" href="index.php?q=user&action=edit&id=' + data.values[x].id + '">Edit</a><a class="savebutton delBtn"  href="index.php?q=user&action=delete&id=' + data.values[x].id + '" onclick="javasript:return confirm(\'Are you sure you want to delete this user?\')">Delete</a>');

                                                    tr.append(name, username, email, status, actions);

                                                    $("#user-table tbody").append(tr);
                                                }
                                            }
                                        });
                                    }
                                });
                            });
</script>