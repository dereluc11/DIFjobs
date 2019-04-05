<!--Modal voor admin om de vacature te wijzigen-->
<div class="modal fade" id="adminVacatureWijzigen" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form name="editjob" action="../POST/editjob.php" method="post">
                    <div class="form-group col-lg-6">
                        <label for="job">Functie:</label>
                        <input type="text" id="job" class="form-control" name="job" placeholder="php programeur"
                               value="" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="location">Locatie:</label>
                        <input type="text" id="location" class="form-control" name="location" placeholder="Zoetermeer"
                               value="" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="description">Beschrijving:</label>
                        <textarea id="description" class="form-control" name="description" maxlength="750"
                                  required></textarea>
                    </div>

                    <input type="hidden" id="date" value="" name="date">
                    <input type="hidden" id="title" value="" name="title">
                    <input type="hidden" id="GebruikerID" value="" name="GebruikerID">


                    <div class="col-sm-3 mt-2 pt-sm-4">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
