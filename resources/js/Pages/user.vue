<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User List
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                         role="alert" v-if="$page.props.message">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.message }}</p>
                            </div>
                        </div>
                    </div>
                    <button @click="openModal()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"> Create User
                    </button>
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">#</th>
                            <th class="px-4 py-2">First Name</th>
                            <th class="px-4 py-2">Last Name</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">Home Phone</th>
                            <th class="px-4 py-2">Mobile Phone</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in users.data" :key="row.id">
                            <td class="border px-4 py-2">{{ row.id }}</td>
                            <td class="border px-4 py-2">{{ row.first_name }}</td>
                            <td class="border px-4 py-2">{{ row.last_name }}</td>
                            <td class="border px-4 py-2">{{ row.age }}</td>
                            <td class="border px-4 py-2">{{ row.home_phone }}</td>
                            <td class="border px-4 py-2">{{ row.mobile_phone }}</td>
                            <td class="border px-4 py-2">{{ row.email }}</td>
                            <td class="border px-4 py-2">
                                <button @click="edit(row)"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </button>
                                <button @click="deleteRow(row)"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                 role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <form>
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="cus-form">
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">First name:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.first_name">
                                                <div v-if="$page.props.errors.first_name" class="text-red-500">{{
                                                    $page.props.errors.first_name }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Last name:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.last_name">
                                                <div v-if="$page.props.errors.last_name" class="text-red-500">{{
                                                    $page.props.errors.last_name }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder = "yyyy-mm-dd"
                                                       v-model="form.date_of_birth">
                                                <div v-if="$page.props.errors.date_of_birth" class="text-red-500">{{
                                                    $page.props.errors.date_of_birth }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.age">
                                                <div v-if="$page.props.errors.age" class="text-red-500">{{
                                                    $page.props.errors.age }}
                                                </div>
                                            </div>
                                          <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Home Phone:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.home_phone">
                                                <div v-if="$page.props.errors.home_phone" class="text-red-500">{{
                                                    $page.props.errors.home_phone }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Mobile Phone:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.mobile_phone">
                                                <div v-if="$page.props.errors.mobile_phone" class="text-red-500">{{
                                                    $page.props.errors.mobile_phone }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder = "xyz@gmail.com"
                                                       v-model="form.email">
                                                <div v-if="$page.props.errors.email" class="text-red-500">{{
                                                    $page.props.errors.email }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Street Address:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.street_address">
                                                <div v-if="$page.props.errors.street_address" class="text-red-500">{{
                                                    $page.props.errors.street_address }}
                                                </div>
                                            </div>

                                             <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">City:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.city">
                                                <div v-if="$page.props.errors.city" class="text-red-500">{{
                                                    $page.props.errors.city }}
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">State:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.state">
                                                <div v-if="$page.props.errors.state" class="text-red-500">{{
                                                    $page.props.errors.state }}
                                                </div>
                                            </div>
                                             <div class="mb-4">
                                                <label 
                                                       class="block text-gray-700 text-sm font-bold mb-2">Zipe Code:</label>
                                                <input type="text"
                                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        
                                                       v-model="form.zip_code">
                                                <div v-if="$page.props.errors.zip_code" class="text-red-500">{{
                                                    $page.props.errors.zip_code }}
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                                      class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                      v-show="!editMode" @click="save(form)">
                                Save
                              </button>
                            </span>
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                                      class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                      v-show="editMode" @click="update(form)">
                                Update
                              </button>
                            </span>
                                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                              <button @click="closeModal()" type="button"
                                      class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>
<style>
.cus-form {
    display: flex;
    flex-wrap: wrap;
}
.cus-form .mb-4 {
    margin: 4px 10px;
    max-width: 45%;
}
</style>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    
    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props: {
            errors: Object,
            users: Object,
        },
        data() {
            return {
                current: 1,
                perPage: 5,
                // total: 20,
                editMode: false,
                isOpen: false,
                form: {
                
                    first_name:null,
                    last_name:null,
                    date_of_birth:null,
                    age:null,
                    home_phone:null,
                    mobile_phone:null,
                    email:null,
                    street_address:null,
                    city:null,
                    state:null,
                    zip_code:null,
                    current_time_at_home:null
                    
                },
            }
        },
        created() {
            var today = new Date()
            var now_time = (today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()).toString();
            this.form.current_time_at_home  = now_time;
        },

        methods: {
            openModal() {
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                this.reset();
                this.editMode = false;
            },
            reset() {
                 Object.keys(this.form).forEach(key => {
                    this.form[key] = null;
                });
            },
            save(users) {
               
                this.$inertia.post('/user', users)
                    .then((response) => {
                     if(!Object.values(this.errors).length){
                        this.reset();
                        this.closeModal();
                        this.editMode = false;
                        Toast.fire({
                            icon: 'success',
                            title: 'User Save successfully!'
                        });
                        }
                    });
                
            },
            edit(users) {
                this.form = Object.assign({}, users);
                this.editMode = true;
                this.openModal();
            },
            update(users) {
               
                users._method = 'PATCH';
                this.$inertia.post('/user/edit/' + users.id, users)
                    .then(() => {
                        if(!Object.values(this.errors).length){
                          this.reset();
                          this.closeModal();
                        Toast.fire({
                            icon: 'success',
                            title: 'User updated successfully'
                        });
                        }
                    });
                
            },
            deleteRow(users) {
                Swal.fire({
                    title: 'Sure?',
                    text: "Are you sure to delete",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Delete'
                }).then((result) => {

                    if (result.value) {
                        users._method = 'DELETE';
                        this.$inertia.post('/user/delete/' + users.id, users)
                            .then(() => {

                                Swal.fire(
                                    'Deleted successfully',
                                    'success'
                                );
                            }).catch(() => {

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo correu mal!',
                                footer: '<a href="#">Porquê que tenho erro?</a>'
                            });
                        });
                    }
                });

                this.reset();
                this.closeModal();
            },

            
        },
    }
</script>