<template>
    <div class="container">
        <div class="row header" style="text-align:center;color:green">
            <br><h3>List of E-commerce Companies</h3>
        </div><br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">+Add</button>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create Company Info</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label for="company-name">Company Name:</label>
                                <input type="text" class="form-control" v-model="informationform.companyname" id="company-name" aria-describedby="company" placeholder="Enter the name of the company">
                            </div>
                            <div class="form-group">
                                <label for="inceptionyear">Year Founded</label>
                                <input type="number" class="form-control" v-model="informationform.inceptionyear" id="inceptionyear" placeholder="Year of inception" required>
                            </div>
                            <div class="form-group">
                                <label for="hq">Headquarters</label>
                                <input type="text" class="form-control" v-model="informationform.hq" id="hq" placeholder="headquarters" required>
                            </div>
                            <div class="form-group">
                                <label for="founder_name">Founder</label>
                                <input type="text" class="form-control" v-model="informationform.founder_name" id="founder_name" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="worth">Net worth</label>
                                <input type="text" class="form-control" v-model="informationform.networth" id="worth" placeholder="" required>
                            </div>
                            <button type="submit" class="btn btn-primary" @click="infosubmit">Submit</button>
                        </form>
                    </div>
                    <!--
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Edit Company Info</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submit" id="editform">
                            <div class="form-group">
                                <label for="company-name">Company Name:</label>
                                <input type="text" class="form-control" id="company_edit"  aria-describedby="company" placeholder="Enter the name of the company">
                            </div>
                            <div class="form-group">
                                <label for="inceptionyear">Year Founded</label>
                                <input type="number" class="form-control" id="year_founded_edit"  placeholder="Year of inception" required>
                            </div>
                            <div class="form-group">
                                <label for="hq">Headquarters</label>
                                <input type="text" class="form-control" id="hq_edit"  placeholder="headquarters" required>
                            </div>
                            <div class="form-group">
                                <label for="founder_name">Founder</label>
                                <input type="text" class="form-control" id="founder_edit"  placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="worth">Net worth</label>
                                <input type="text" class="form-control" id="networth_edit" placeholder="" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="saveinfo">Save</button>
                        </form>
                    </div>
                    <!--
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close1">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Company Name</th>
                <th>Year Founded</th>
                <th>Headquarters</th>
                <th>Founder</th>
                <th>Net Worth</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="company in companies" :key="company.id">
                <td>{{company.company_name}}</td>
                <td>{{company.year_founded}}</td>
                <td>{{company.headquarters}}</td>
                <td>{{company.founder}}</td>
                <td>{{company.company_worth}}</td>
                <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" v-on:click="edit(company.company_name)" data-target="#myModal1">Edit</button>
                    &nbsp;
                    <button type="button" class="btn btn-danger" data-toggle="modal" v-on:click="destroy(company.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: ['companies'],
    data(){
      return{
          informationform: {
              companyname: '',
              founder_name: '',
              inceptionyear: '',
              networth : '',
              hq: '',
          },
      }
    },
    methods: {
        addinfo : function (event)
        {
            alert('Hello there');
        },
        infosubmit : function()
        {
            axios.post('/create', this.informationform)
            .then((response) => {
                if(response.status == 200){
                    alert(response['data']);
                    location.reload();
                }
            });
        },
        destroy(company_name)
        {
            var input = company_name;
            axios.post('/destroy/'+input)
                .then((response) => {
                    if(response.status == 200){
                        alert(response['data']);
                        location.reload();
                    }
                });
        },
        edit(company_name)
        {
           var input = company_name;
            axios.get('/edit/'+input)
                .then((response) => {
                    if(response.status == 200){
                        $("#company_edit").val(response['data']['company_info'][0]['company_name']);
                        $("#year_founded_edit").val(response['data']['company_info'][0]['year_founded']);
                        $("#hq_edit").val(response['data']['company_info'][0]['headquarters']);
                        $("#founder_edit").val(response['data']['company_info'][0]['founder']);
                        $("#networth_edit").val(response['data']['company_info'][0]['company_worth']);
                        $( "#saveinfo" ).click(function() {
                            var updateObj = new Object();
                            updateObj.company_id = response['data']['company_info']['0']['id'];
                            updateObj.company_name = $("#company_edit").val();
                            updateObj.year_founded = $("#year_founded_edit").val();
                            updateObj.hq = $("#hq_edit").val();
                            updateObj.founder = $("#founder_edit").val();
                            updateObj.net_worth = $("#networth_edit").val();
                            var updated_data = JSON.stringify(updateObj);
                            updated_data = encodeURIComponent(updated_data);
                            axios.post('/save/'+updated_data)
                                .then((response) => {
                                    if(response.status == 200){
                                        location.reload();
                                    }
                                });
                        });
                    }
                });
        },
    }
}
</script>




