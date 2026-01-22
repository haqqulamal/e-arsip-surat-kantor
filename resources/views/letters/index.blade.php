<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Arsip Surat Kantor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, #0d6efd, #0dcaf0);
            border: none;
        }

        .badge-biasa {
            background-color: #6c757d;
        }

        .badge-penting {
            background-color: #ffc107;
            color: #000;
        }

        .badge-rahasia {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold text-primary">E-Arsip Surat Kantor</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Form Input -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 fw-bold" id="form-title">Tambah Surat Baru</h5>
                        <form action="{{ route('letters.store') }}" method="POST" enctype="multipart/form-data"
                            id="letter-form">
                            @csrf
                            <input type="hidden" name="_method" value="POST" id="form-method">

                            <div class="mb-3">
                                <label class="form-label">Nomor Surat</label>
                                <input type="text" name="letter_number" id="letter_number" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Perihal</label>
                                <input type="text" name="subject" id="subject" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Surat</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Klasifikasi</label>
                                <select name="classification_id" id="classification_id" class="form-select" required>
                                    <option value="">-- Pilih Klasifikasi --</option>
                                    @foreach($classifications as $c)
                                        <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Departemen</label>
                                <select name="department_id" id="department_id" class="form-select" required>
                                    <option value="">-- Pilih Departemen --</option>
                                    @foreach($departments as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Sifat Surat</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="urgency" id="urg_biasa"
                                        value="biasa" checked>
                                    <label class="form-check-label" for="urg_biasa">Biasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="urgency" id="urg_penting"
                                        value="penting">
                                    <label class="form-check-label" for="urg_penting">Penting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="urgency" id="urg_rahasia"
                                        value="rahasia">
                                    <label class="form-check-label" for="urg_rahasia">Rahasia</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File Surat (PDF)</label>
                                <input type="file" name="file_path" id="file_path" class="form-control"
                                    accept="application/pdf">
                                <small class="text-muted" id="file-hint">*Wajib untuk surat baru</small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Simpan Surat</button>
                                <button type="button" class="btn btn-secondary d-none" id="btn-cancel"
                                    onclick="resetForm()">Batal Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Surat -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-bold mb-0">Daftar Arsip Surat</h5>
                            <a href="{{ route('letters.export') }}" class="btn btn-success btn-sm">Rekap Arsip Excel</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Perihal & Departemen</th>
                                        <th>Klasifikasi</th>
                                        <th>Tanggal</th>
                                        <th>Sifat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($letters as $index => $letter)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $letter->letter_number }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $letter->subject }}</div>
                                                <small class="text-muted">{{ $letter->department->name }}</small>
                                            </td>
                                            <td><span
                                                    class="badge bg-info text-dark">[{{ $letter->classification->code }}]</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($letter->date)->format('d-m-Y') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $letter->urgency }}">
                                                    {{ ucfirst($letter->urgency) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    @if($letter->file_path)
                                                        <a href="{{ asset('storage/' . $letter->file_path) }}" target="_blank"
                                                            class="btn btn-info" title="Lihat PDF">👁️</a>
                                                    @endif
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="editLetter({{ json_encode($letter) }})"
                                                        title="Edit">✏️</button>
                                                    <form action="{{ route('letters.destroy', $letter->id) }}" method="POST"
                                                        onsubmit="return confirm('Hapus surat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            title="Hapus">🗑️</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data surat.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editLetter(letter) {
            const form = document.getElementById('letter-form');
            const title = document.getElementById('form-title');
            const method = document.getElementById('form-method');
            const btnSubmit = document.getElementById('btn-submit');
            const btnCancel = document.getElementById('btn-cancel');
            const fileHint = document.getElementById('file-hint');

            title.innerText = 'Edit Surat';
            form.action = `/letters/${letter.id}`;
            method.value = 'PUT';
            btnSubmit.innerText = 'Perbarui Surat';
            btnCancel.classList.remove('d-none');
            fileHint.innerText = '*Kosongkan jika tidak ingin mengubah file';

            document.getElementById('letter_number').value = letter.letter_number;
            document.getElementById('subject').value = letter.subject;
            document.getElementById('date').value = letter.date;
            document.getElementById('classification_id').value = letter.classification_id;
            document.getElementById('department_id').value = letter.department_id;

            document.getElementById('urg_' + letter.urgency).checked = true;
        }

        function resetForm() {
            const form = document.getElementById('letter-form');
            const title = document.getElementById('form-title');
            const method = document.getElementById('form-method');
            const btnSubmit = document.getElementById('btn-submit');
            const btnCancel = document.getElementById('btn-cancel');
            const fileHint = document.getElementById('file-hint');

            form.reset();
            title.innerText = 'Tambah Surat Baru';
            form.action = "{{ route('letters.store') }}";
            method.value = 'POST';
            btnSubmit.innerText = 'Simpan Surat';
            btnCancel.classList.add('d-none');
            fileHint.innerText = '*Wajib untuk surat baru';
        }
    </script>
</body>

</html>