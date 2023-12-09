<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Emergency Medicine Department Research | Registration Page</title>
        {{-- @vite('resources/css/app.css') --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="{{ secure_asset('assets/vendor/filepond/filepond.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    </head>
<body>
  
<div class="flex justify-center mx-auto m-8">
    <form action="{{ secure_url('application') }}" method="POST" class="grid grid-cols-1
    md:grid-cols-2 gap-4 p-4 shadow-md  rounded border border-gray-200">
        {!! csrf_field() !!}
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
            <input type="text" placeholder="First Name" value="{{ old('first_name') }}" id="first_name" name="first_name" 
                class="mt-1 p-2 border rounded-md w-full @error('first_name') border-red-500 @enderror">
            @error('first_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
            <input type="text" placeholder="Last Name" value="{{ old('last_name') }}"
                 id="last_name" name="last_name" class="mt-1 p-2 border rounded-md w-full @error('last_name') border-red-500 @enderror">
            @error('last_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" placeholder="Email" id="email" value="{{ old('email')}}"
                   name="email" class="mt-1 p-2 border rounded-md w-full @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number:</label>
            <input type="number" placeholder="ID Number" id="id_number" 
                   value="{{ old('id_number')}}"
                   name="id_number" class="mt-1 p-2 border rounded-md w-full @error('id_number') border-red-500 @enderror">
            @error('id_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="SCHFS" class="block text-sm font-medium text-gray-700">ISCHFS registration number (If exists)</label>
            <input type="number" placeholder="SCHFS registration number" 
            value="{{ old('SCHFS') }}"
            id="SCHFS" name="SCHFS" class="mt-1 p-2 border rounded-md w-full @error('SCHFS') border-red-500 @enderror">
            @error('SCHFS')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-4">
            <label for="topic" class="block text-sm font-medium text-gray-700">Article Topic:</label>
            <select id="topic" name="artical" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="EMS">EMS</option>
                <option value="Resuscitation">Resuscitation</option>
                <option value="Toxicology">Toxicology</option>
                <option value="Trauma">Trauma</option>
                <option value="Medical emergency">Medical emergency</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Imaging">Imaging</option>
                <option value="Environmental">Environmental</option>
                <option value="ED Admin">ED Admin</option>
                <option value="Critical Care">Critical Care</option>
                <option value="Cardiovascular">Cardiovascular</option>
                <option value="Paramedicine">Paramedicine</option>
                <option value="Disaster Medicine">Disaster Medicine</option>
                <option value="Airway">Airway</option>
                <option value="Procedure">Procedure</option>
                <option value="Ethics">Ethics</option>
                <option value="Neurology">Neurology</option>
                <option value="Other">Other</option>
            </select>
            @error('artical')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
            
        </div>
        

        <!-- Add similar code for Last Name, Email, ID Number, Article Topic, Article Title, Presenting author, etc. -->

        <div class="mb-4">
            <label for="affiliation" class="block text-sm font-medium text-gray-700">Affiliation:</label>
            <select id="affiliation" name="affiliation" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="KAMC">King Abdulaziz Medical City (KAMC) Riyadh</option>
                <option value="KSMC">King Saud Medical City (KSMC)</option>
                <option value="KFSH">King Faisal Specialist Hospital & Research Center (KFSH)</option>
                <option value="PSMMC">Prince Sultan Military Medical City (PSMMC)</option>
                <option value="PMAH">Prince Mohammed bin Abdulaziz Hospital (PMAH)</option>
                <option value="KKUH">King Khalid University Hospital (KKUH)</option>
                <option value="SFH">Security Force Hospital (SFH) – Riyadh</option>
                <option value="Other">Other</option>
            </select>
            @error('affiliation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
            <!-- If Other is selected, show an input field for other affiliation -->
          
        </div>

        <div class="mb-4 md:col-span-2">
            <label for="co_authors" class="block text-sm font-medium text-gray-700">Co-author(s):</label>
            <div id="repeater" class="reperter">
                <button type="button"  data-repeater-create class="px-4 py-2 bg-blue-500 text-white rounded-md">
                    Add Co-auther
                </button>
                <div  class="items" data-repeater-list="co_authors">
                    <div class="item flex justify-center align-middle gap-2 mt-5" data-repeater-item>
                        <div class="w-full">
                            <label for="co_authors" class="block text-sm font-medium text-gray-700">Co-author(s):</label>
                            <input name="co_authors" name="co_authors" type="text" id="co_authors"  class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('co_authors')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                             @enderror
                        </div>
                        
                        <div class="pull-right repeater-remove-btn col-md-2 mt-5 flex items-center">
                            <button type="button" data-repeater-delete class="px-4 py-2 bg-red-500 text-white rounded-md">
                                Remove
                            </button>
                        </div>
                    </div>

                </div>

            </div>
           
        </div>
        <div class="mb-4">
            <label for="abstract" class="block text-sm font-medium text-gray-700">Abstract Upload</label>
            <input type="file" class="filepond" name="abstract" name="abstract" id="abstract">
            @error('abstract')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-4">
            <label for="figures" class="block text-sm font-medium text-gray-700">Figures and tables upload</label>
            <input type="file" class="filepond2" name="figures"  name="figures" id="figures">
            @error('figures')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        </div>
        

        <!-- Add similar code for Abstract upload, Figures and tables upload, SCHFS registration number, etc. -->

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
        </div>

    </form>
   
</div>
<script src="{{ secure_asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ secure_asset('assets/js/jquery-repeater.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
@if(session()->has('message'))
    <script>
        Swal.fire({
            title: "Success",
            text: "Registration successful",
            icon: "success"
        });
        setTimeout(function() {
                  window.location.href = '/';
              }, 3000); 
    </script>
@endif

<script>
    $("#repeater").repeater({
        isFirstItemUndeletable: true,
        show: function() {
            var formLabel = $(this).find('.form-label');
            var label = $(this).find('.activity-group-text');
            console.log($(this).data('itemName'));
            var itemName = $(this).data('itemName');
            var numbers = itemName.match(/\d+/g);
            var incrementedNumbers = numbers.map(function(number) {
                return parseInt(number) + 1;
            });
            console.log(incrementedNumbers)
            var va = label.text();
            va++;
            label.text(incrementedNumbers);
          
            $(this).slideDown();
        },
        hide: function(e) {
            var labels = $(this).parent().find('.activity-group-text');
            var label2 = $(this).find('.activity-group-text');


            $(this).slideUp(e);
        }

    });
   
</script>
 <script src="{{ secure_asset('assets/vendor/filepond/filepond-plugin-file-validate-type.min.js') }}"></script>
 <script src="{{ secure_asset('assets/vendor/filepond/filepond.js') }}"></script>
 
 {{-- <script src="assets/vendor/filepond/filepond-plugin-file-validate-type.min.js"></script> --}}

 <script>
   
FilePond.registerPlugin(
FilePondPluginFileValidateType,
)
FilePond.create(document.querySelector(".filepond"), {
credits: null,
allowImagePreview: false,
acceptedFileTypes: ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/doc"],

server: {
process: (fieldName, file, metadata, load, error, progress, abort) => {
  // We ignore the metadata property and only send the file

  const formData = new FormData()
  formData.append('fieldName', fieldName);
  formData.append('file', file);
  formData.append('name', file.name);

  const request = new XMLHttpRequest()
  // you can change it by your client api key
  request.open(
    "POST",
    "/api/upload"
  )

  request.upload.onprogress = (e) => {
    progress(e.lengthComputable, e.loaded, e.total)
  }

  request.onload = function () {
    if (request.status >= 200 && request.status < 300) {
        let response = JSON.parse(request.responseText);
      load(response.file)
    } else {
      error("oh no")
    }
  }
  request.send(formData)
},
},
fileValidateTypeDetectType: (source, type) =>
new Promise((resolve, reject) => {
  // Do custom type detection here and return with promise
  resolve(type)
}),
storeAsFile: true,
})


FilePond.create(document.querySelector(".filepond2"), {
credits: null,
allowImagePreview: false,
acceptedFileTypes: ["application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/doc"],

server: {
process: (fieldName, file, metadata, load, error, progress, abort) => {
  // We ignore the metadata property and only send the file

  const formData = new FormData()
  formData.append('fieldName', fieldName);
  formData.append('file', file);
  formData.append('name', file.name);

  const request = new XMLHttpRequest()
  // you can change it by your client api key
  request.open(
    "POST",
    "/api/upload"
  )

  request.upload.onprogress = (e) => {
    progress(e.lengthComputable, e.loaded, e.total)
  }

  request.onload = function () {
    if (request.status >= 200 && request.status < 300) {
        let response = JSON.parse(request.responseText);
      load(response.file)
    } else {
      error("oh no")
    }
  }
  request.send(formData)
},
},
storeAsFile: true,
})

    </script>
</body>
</html>