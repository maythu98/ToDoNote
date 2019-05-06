<template>
	<div class="container">
		<div class="row">
			<div class="col-md-3 shadow p-3 mb-5 bg-white rounded">
				<div class="form-group">
					<input type="text" name="title" class="form-control" @click="createList" placeholder="Title">	
				</div>
				<div class="form-group">
					<textarea type="text" rows="1" name="note" aria-label="note" class="form-control" placeholder="Take a note" v-show="formDetail"></textarea>
				</div>
				<button @click="SaveNote"  v-show="NoteVisible"> Close </button>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				formDetail: false,
				RowNumber: 2,
			}
		},
		methods: {
			createList() {
				this.formDetail = true;
			},
			NotDetail() {
				this.formDetail = false;
			},
            SaveNote() {

            },
			expandNoteArea() {
				this.RowNumber +=1;
			}

		},

		mounted() {
		}

	};
</script>