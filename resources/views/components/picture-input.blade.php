<div class="flex items-center" x-data="">
    <div class="rounded-md bg-gray-200 mr-2" >
        <img id="preview" src="" alt="" class="w-24 h-24 rounded-md object-cover" >
    </div>
    <div>
        <button @click="document.getElementById('profile_picture').click()" class="relative">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                Upload picture
            </div>
            <input @change="showPreview(event)" type="file" name="profile_picture" id="profile_picture" class="absolute inset-0 -z-10 opacity-0"/>
        </button>
    </div>
    <script>
        function picturePreview(){
            return{
                showPreview:(event)=>{
                    if(event.target.files.lenght > 0){
                        var src = URL.createObjectURL(event.target.files[0]);
                        document.getElementById('preview').src = src;
                }
            }
            }
        }
    </script>
</div>
