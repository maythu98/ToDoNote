<template>
	<div class="container">
		<div class="row">
			<div class="col-md-7 shadow p-3 mb-5 bg-white rounded">
				<div v-show="formDetail">
					<img v-for="image in images" :name="files" :src="image" class="img-fluid pb-2">
				</div>
				<div class="form-group">
					<input ref="NoteTitle" type="text" name="title" class="form-control" placeholder="Title" v-show="formDetail">	
				</div>
				<div class="form-group">
					<textarea ref="NoteContent" type="text" rows="1" name="note" @click="createList" class="form-control" 
					placeholder="Take a note ..."></textarea>
				</div>
				<div v-show="formDetail">
					<input type="file" v-on:change="onFileChange">
				</div>
				<div v-show="formDetail" class="form-group pt-3">
					<button @click="SaveNote" class="btn btn-secondary margin-left"> Save </button>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="card-columns col-md-12">
				<div class="card text-white bg-secondary m-2" data-toggle="modal" :data-target="'#form' + note_id" v-on:mouseover="noteOver(note.id)" v-on:mouseleave="noteLeave" v-for="note in notes" @click="noteEdit(note.id)" :key="note.id">
					<blockquote class="blockquote mb-0 card-body">
						<div>
							<img v-for="image in note.image" :src="'storage/images/' + image" alt="" class="img-fluid">

							<h2>{{note.title}}</h2>
							<p style="white-space: pre-wrap; word-wrap:break-word">{{note.note}}</p>
						</div>
					</blockquote>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" :id="'form'+ this.note_id" tabindex="-1" role="dialog" aria-labelledby="edifForm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-body">
				<div class="form-group">
					<input type="text" ref="UpdateTitle" name="title" :value="editNote.title" class="form-control" placeholder="Title">
				</div>
				<div class="form-group">
					<textarea type="text" ref="UpdateNote" rows="5" name="note" aria-label="note" class="form-control" :value="editNote.note">	</textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="noteUpdate(editNote.id)">Close</button>
			</div>
			</div>
		</div>
		</div>
	</div>
</template>
<script>
import { log } from 'util';
	export default {
		data() {
			return {
				formDetail: false,
				rows: 1,
				RowNumber: 2,
				notes: [],
				editNote: [],
				note_id: '',
				images:[],
				files: []
			}
		},
		methods: {
			createList() {
				this.formDetail = true;
				this.rows = 2;
			},
			showall() {
				axios.get('/show').then((response)=> {
					response.data.forEach(element => {
						element.image = JSON.parse(element.image);
					});
					this.notes = response.data;
				});
				
			},
			// Image
			onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.images.push(e.target.result);
                };
                reader.readAsDataURL(file);
            },
            SaveNote() {
				axios.post('/store', {
					title: this.$refs.NoteTitle.value,
					note: this.$refs.NoteContent.value,
					images: this.images,
				}).then(response=> {
					this.showall();
					this.images = [];
					this.$refs.NoteTitle.value = "";
					this.$refs.NoteContent.value = "";
				})
			},
			noteEdit(id) {
				axios.get('/editshow/' + id).then(response=> {
					this.editNote = response.data;
				})
			},
			noteUpdate(id) {
				axios.post('/updateNote/' + id, {
					title: this.$refs.UpdateTitle.value,
					note: this.$refs.UpdateNote.value
				}).then(response=> {
					this.editNote = [];
					this.showall();
				})
			},
			fileUpload() {
				console.log('image');
			},
			noteOver(id) {
				this.note_id = id;
			},
			noteLeave() {
				this.note_id = '';
			},

		},

		mounted() {
			this.showall();
		}

	};
</script>