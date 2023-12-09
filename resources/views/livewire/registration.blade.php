<!-- resources/views/livewire/emergency-research-registration.blade.php -->

<div class="flex justify-center mx-auto m-8">
    <form wire:submit.prevent="submitForm" class="grid lg:grid-cols-2 gap-4 p-4 shadow-md  rounded border border-gray-200">
        <div class="mb-4">
            <x-input wire:model="first_name" label="First Name" placeholder="First name" />
        </div>
        <div class="mb-4">
            <x-input wire:model="last_name" label="Last Name" placeholder="Last name" />
        </div>
        <div class="mb-4">
            {{-- <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" id="email" wire:model="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full"> --}}
            <x-input type="email" wire:model="email" label="Email" placeholder="Email" />
        </div>
        <div class="mb-4">
            <x-input type="number" wire:model="id_number" label="ID Number" placeholder="ID Number" />
        </div>
        <div class="mb-4">
            <x-input type="number" wire:model="SCHFS" label="SCHFS registration number (If exists)" placeholder="SCHFS registration number" />
        </div>
        <div class="mb-4">
            <label for="topic" class="block text-sm font-medium text-gray-700">Article Topic:</label>
            <select id="topic" wire:model="article_topic" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
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
            @if($article_topic === 'Other')
                <input type="text" id="other_topic" wire:model="other_topic" placeholder="Enter Other Topic" class="input-field">
            @endif
        </div>
        

        <!-- Add similar code for Last Name, Email, ID Number, Article Topic, Article Title, Presenting author, etc. -->

        <div class="mb-4">
            <label for="affiliation" class="block text-sm font-medium text-gray-700">Affiliation:</label>
            <select id="affiliation" wire:model="affiliation" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="KAMC">King Abdulaziz Medical City (KAMC) Riyadh</option>
                <option value="KSMC">King Saud Medical City (KSMC)</option>
                <option value="KFSH">King Faisal Specialist Hospital & Research Center (KFSH)</option>
                <option value="PSMMC">Prince Sultan Military Medical City (PSMMC)</option>
                <option value="PMAH">Prince Mohammed bin Abdulaziz Hospital (PMAH)</option>
                <option value="KKUH">King Khalid University Hospital (KKUH)</option>
                <option value="SFH">Security Force Hospital (SFH) – Riyadh</option>
                <option value="Other">Other</option>
            </select>
            <!-- If Other is selected, show an input field for other affiliation -->
            @if($affiliation === 'Other')
                <input type="text" id="other_affiliation" wire:model="other_affiliation" placeholder="Enter Other Affiliation" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            @endif
        </div>

        <div class="mb-4 col-span-2">
            <label for="co_authors" class="block text-sm font-medium text-gray-700">Co-author(s):</label>
            <div id="repeater" class="reperter">
                <button type="button"  data-repeater-create class="px-4 py-2 bg-blue-500 text-white rounded-md">
                    Add Co-auther
                </button>
                <div  class="items" data-repeater-list="co_authors">
                    <div class="item flex justify-center align-middle gap-2 mt-5" data-repeater-item>
                        <div class="w-full">
                            <label for="co_authors" class="block text-sm font-medium text-gray-700">Co-author(s):</label>
                            <input name="co_authors" wire:model="co_authors" type="text" id="co_authors"  class="mt-1 p-2 border border-gray-300 rounded-md w-full">
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
            <input type="file" class="filepond" wire:model="abstract" name="abstract" id="abstract">
        </div>
        <div class="mb-4">
            <label for="figures" class="block text-sm font-medium text-gray-700">Figures and tables upload</label>
            <input type="file" class="filepond2" wire:model="figures"  name="figures" id="figures">
        </div>
        

        <!-- Add similar code for Abstract upload, Figures and tables upload, SCHFS registration number, etc. -->

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
        </div>

    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-repeater.js"></script>
   
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
     <script src="assets/vendor/filepond/filepond-plugin-file-validate-type.min.js"></script>
     <script src="assets/vendor/filepond/filepond.js"></script>
     
     {{-- <script src="assets/vendor/filepond/filepond-plugin-file-validate-type.min.js"></script> --}}

     <script>
        // FilePond.parse(document.body);
//         FilePond.registerPlugin(
//   FilePondPluginImagePreview,
//   FilePondPluginImageCrop,
//   FilePondPluginImageExifOrientation,
//   FilePondPluginImageFilter,
//   FilePondPluginImageResize,
//   FilePondPluginFileValidateSize,
//   FilePondPluginFileValidateType,
// )

// Filepond: Basic
// FilePond.create(document.querySelector(".filepond"), {
//   credits: null,
//   allowImagePreview: false,
//   allowMultiple: false,
//   allowFileEncode: false,
//   required: false,
//   storeAsFile: true,
// })
// Filepond: ImgBB with server property
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
</div>
