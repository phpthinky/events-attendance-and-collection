<main>
  
  <section class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2>Import student data by section</h2>
        <a href="<?=base_url('assets/excel_template.xlsx')?>" download="excel-template.xlsx" >Download template</a>
      </div>
      <div class="card-body">
        
        <form class="form-horizontal" id="form-import">
          
            <div class="row form-group">
              <label for="import_excel" class="col-md-2">Choose excel file</label>
              <div class="col-md-8">
              <input type="file" name="import_excel" id="import_excel" accept=".xls,.xlsx">
                
              </div>
            </div>
            <div class="row form-group">
              <input type="submit" name="submit" value="Import now" id="btn-import-now" class="btn btn-sm btn-outline-success" disabled="true">
            </div>

            <div class="alert"></div>
        </form>
      </div>
    </div>
  </section>
</main>