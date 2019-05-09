<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users List</h3>
                <div class="card-tools">
                    <button class = "btn btn-success" @click="addModal()">
                        Add New<i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Slug</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users":key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td><span class="tag tag-success">{{user.slug}}</span></td>
                    <td>
                        <a href="#" @click="editModal(user)"><i class="fa fa-edit"></i></a>
                        <a href="#" @click="deleteUser(user.id)"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewTitle" v-show="!editmode">Add New</h5>
                <h5 class="modal-title" id="addNewTitle" v-show="editmode">Update User Info's</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateUser():createUser()" >
              <div class="modal-body">

                <div class="form-group">
                  <input v-model="form.name" type="text" name="name" placeholder="Name" id="name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="name"></has-error>
                </div>

                <div class="form-group">
                  <input v-model="form.email" type="email" name="email" placeholder="Email" id="email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                  <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                  <input v-model="form.password" type="text" name="password" placeholder="Password" id="password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                  <has-error :form="form" field="password"></has-error>
                </div>

                <div class="form-group">
                  <input v-model="form.bio" type="text" name="bio" placeholder="Bio" id="bio"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                  <has-error :form="form" field="bio"></has-error>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
              </div>

              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform';
    import Swal from 'sweetalert2';

    export default {
        data () {
            return {
              editmode: false,
              users:[],
              // Create a new form instance
              form: new Form({
                id: '',
                name: '',
                email: '',
                bio: '',
                password: '',
                slug: '',
              })
            }
          },
          methods:{
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                        //send request to server
                        if(result.value){
                          this.$Progress.start();
                          this.form.delete('api/user/'+id).then(()=>{
                              Swal.fire(
                                  'Deleted!',
                                  'Your file has been deleted.',
                                  'success'
                              )
                             this.loadUsers();
                          }).catch(()=>{
                                  swal("Failed!","There was something wrong","warning");
                          });
                          this.$Progress.finish();
                    }
                })
            },
            loadUsers(){
              axios.get("api/user").then(({data})=>(this.users = data.data));
            },

            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then(()=>{
                    Swal.fire(
                        'update!',
                        'Your file has been updated.',
                        'success'
                    )
                    $('#addNew').modal('hide');
                    this.loadUsers();
                    this.$Progress.finish();

                })
                .catch(()=>{
                    this.$Progress.fail();
                })

            },

            editModal(user){
              this.editmode=true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(user)
            },

            addModal(){
                this.editmode=false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            createUser(){
              this.$Progress.start();
              this.form.post('api/user');
              Fire.$emit('AfterCreate');
              $('#addNew').modal('hide');
//                toast({
//                    type:'success',
//                    title:'User created successfully',
//                })
            this.$Progress.finish();
          }
        },

        created(){
            this.loadUsers();
            Fire.$on('AfterCreate',()=>{
                this.loadUsers();
            })
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
