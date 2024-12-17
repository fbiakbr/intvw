<template>
    <div class="p-4">
        <button class="btn btn-primary" @click="clickAddButton">Tambah</button>
        <div class="overflow-x-auto my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Lahir</th>
                        <th>Jabatan</th>
                        <th>Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr
                        v-for="(pegawai, index) in data_pegawai"
                        :key="pegawai.id"
                    >
                        <td>{{ pegawai.nip }}</td>
                        <td>{{ pegawai.nama }}</td>
                        <td>{{ pegawai.jenis_kelamin }}</td>
                        <td>{{ pegawai.tanggal_lahir }}</td>
                        <td>{{ pegawai.jabatan }}</td>
                        <td>{{ pegawai.unit_kerja }}</td>
                        <td>
                            <button
                                class="btn btn-warning"
                                @click="clickUpdateButton(index)"
                            >
                                Edit</button
                            ><button
                                class="btn btn-error"
                                onclick="delete_pegawai_modal.showModal()"
                                @click="clickDeleteButton(index)"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <dialog
        id="add_pegawai_modal"
        class="modal"
        :class="{ modal: true, 'modal-open': add_pegawai_modal }"
    >
        <div class="modal-box">
            <div class="divider"></div>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Nama Pegawai</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan Nama"
                    class="input input-bordered w-full"
                    v-model="form.nama"
                />
                <span
                    v-for="error in v$.nama.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">NIP</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan NIP"
                    class="input input-bordered w-full"
                    v-model="form.nip"
                />
                <span
                    v-for="error in v$.nip.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jenis Kelamin</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.jenis_kelamin"
                >
                    <option disabled selected>Jenis Kelamin</option>
                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                    <option value="PEREMPUAN">PEREMPUAN</option>
                </select>
                <span
                    v-for="error in v$.jenis_kelamin.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </div>
                <input
                    type="date"
                    placeholder="Tanggal Lahir"
                    class="input input-bordered w-full"
                    v-model="form.tanggal_lahir"
                />
                <span
                    v-for="error in v$.tanggal_lahir.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jabatan</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.jabatan"
                >
                    <option disabled selected>Pilih Jabatan</option>
                    <option value="KEPALA">KEPALA</option>
                    <option value="SEKRETARIS">SEKRETARIS</option>
                    <option value="STAFF">STAFF</option>
                </select>
                <span
                    v-for="error in v$.jabatan.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Unit</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.unit_kerja"
                >
                    <option disabled selected>Pilih Unit</option>
                    <option value="IT">IT</option>
                    <option value="NON_IT">NON IT</option>
                </select>
                <span
                    v-for="error in v$.unit_kerja.$errors"
                    :key="error.$uid"
                    class="text-red-500"
                    >{{ error.$message }}</span
                >
            </label>
            <div class="divider"></div>
            <div class="flex justify-between">
                <button class="btn" @click="closeAddModal" type="button">
                    Close
                </button>
                <button class="btn btn-primary" type="button" @click="onSubmit">
                    Tambah
                </button>
            </div>
        </div>
    </dialog>
    <dialog id="delete_pegawai_modal" class="modal">
        <div class="modal-box">
            <h1>
                Apakah anda ingin menghapus data pegawai :
                {{ data_pegawai[selectedPegawaiIndex?.toString()]?.nama }}
            </h1>
            <div class="flex justify-between my-4">
                <button
                    class="btn btn-primary"
                    onclick="delete_pegawai_modal.close()"
                >
                    Batal
                </button>
                <button
                    class="btn btn-error"
                    @click="deletePegawai(selectedPegawaiIndex.toString())"
                    onclick="delete_pegawai_modal.close()"
                >
                    Hapus
                </button>
            </div>
        </div>
    </dialog>
    <dialog
        id="update_pegawai_modal"
        class="modal"
        :class="{ modal: true, 'modal-open': update_pegawai_modal }"
    >
        <div class="modal-box">
            <h1>Update Pegawai</h1>
            <div class="divider"></div>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Nama Pegawai</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan Nama"
                    class="input input-bordered w-full"
                    v-model="update_form.nama"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">NIP</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan NIP"
                    class="input input-bordered w-full"
                    v-model="update_form.nip"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jenis Kelamin</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.jenis_kelamin"
                >
                    <option disabled selected>Jenis Kelamin</option>
                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                    <option value="PEREMPUAN">PEREMPUAN</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </div>
                <input
                    type="date"
                    placeholder="Tanggal Lahir"
                    class="input input-bordered w-full"
                    v-model="update_form.tanggal_lahir"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jabatan</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.jabatan"
                >
                    <option disabled selected>Pilih Jabatan</option>
                    <option value="KEPALA">KEPALA</option>
                    <option value="SEKRETARIS">SEKRETARIS</option>
                    <option value="STAFF">STAFF</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Unit</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.unit_kerja"
                >
                    <option disabled selected>Pilih Unit</option>
                    <option value="IT">IT</option>
                    <option value="NON_IT">NON IT</option>
                </select>
            </label>
            <div class="divider"></div>
            <div class="flex justify-between">
                <button class="btn" @click="closeUpdateModal" type="button">
                    Close
                </button>
                <button
                    class="btn btn-primary"
                    @click="updatePegawai(selectedPegawaiIndex.toString())"
                    type="button"
                >
                    Update
                </button>
            </div>
        </div>
    </dialog>
    <button @click="logErrors" class="btn btn-warning">Log Errors</button>
</template>

<script setup>
import { ref, onMounted, reactive, computed } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength } from "@vuelidate/validators";
import axios from "axios";
let data_pegawai = ref([]);
let add_pegawai_modal = ref(false);
let update_pegawai_modal = ref(false);
let selectedPegawaiIndex = ref(0);
let form = ref({
    nama: "",
    nip: "",
    jenis_kelamin: "",
    tanggal_lahir: "",
    jabatan: "",
    unit_kerja: "",
});
let update_form = reactive({
    nama: "",
    nip: "",
    jenis_kelamin: "",
    tanggal_lahir: "",
    jabatan: "",
    unit_kerja: "",
});
const validationRules = computed(() => {
    return {
        nama: { required, minLength: minLength(5) },
        nip: { required },
        jenis_kelamin: { required },
        tanggal_lahir: { required },
        jabatan: { required },
        unit_kerja: { required },
    };
});

const v$ = useVuelidate(validationRules, form.value);

onMounted(() => {
    getDataPegawai();
});

const onSubmit = async () => {
    const isFormCorrect = await v$.value.$validate();
    if (!isFormCorrect) {
        return;
    } else {
        await axios.post("/api/pegawai", form.value);
        add_pegawai_modal.value = !add_pegawai_modal.value;
        resetAllForm();
        getDataPegawai();
    }
};

const resetAllForm = () => {
    form.value = {
        nama: "",
        nip: "",
        jenis_kelamin: "",
        tanggal_lahir: "",
        unit_kerja: "",
        jabatan: "",
    };
    update_form = {
        nama: "",
        nip: "",
        jenis_kelamin: "",
        tanggal_lahir: "",
        jabatan: "",
        unit_kerja: "",
    };
};

const clickAddButton = () => {
    v$.value.$reset;
    add_pegawai_modal.value = true;
};

const clickDeleteButton = (id) => {
    selectedPegawaiIndex.value = id;
};

const clickUpdateButton = (id) => {
    selectedPegawaiIndex.value = id;
    update_form = { ...data_pegawai.value[id] };
    update_pegawai_modal.value = true;
};

const closeAddModal = () => {
    add_pegawai_modal.value = false;
    resetAllForm();
    v$.value.$reset();
};

const closeUpdateModal = () => {
    update_pegawai_modal.value = false;
    resetAllForm();
};

const deletePegawai = async (index) => {
    const id = data_pegawai.value[index].id;
    await axios.delete(`/api/pegawai/${id}`);
    getDataPegawai();
};

const updatePegawai = async (index) => {
    const id = data_pegawai.value[index].id;
    await axios.put(`/api/pegawai/${id}`, update_form);
    update_pegawai_modal.value = false;
    resetAllForm();
    getDataPegawai();
};

const getDataPegawai = async () => {
    data_pegawai.value = [];
    const response = await axios.get("/api/pegawai");
    data_pegawai.value = response.data;
};

const logErrors = () => {
    console.log(v$.value.$errors);
};
</script>
