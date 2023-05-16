<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content',$titulo) ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <h1>Administrar usuarios</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Administrar usuarios</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col2">
            <button type="button" class="btn btn-block btn-success" onclick='window.location.href="UsuariosCrear"'><i class="fas fa-plus"></i> Crear usuario</button>
          </div>
          <div class="col2 ml-3">
            <button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Generar PDF</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
<<<<<<< HEAD
                <h3 class="card-title">Gestionar información de los usuarios creados </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if(session('mensaje')){?>
                  <div class="alert alert-danger" role="alert">
                      <?php echo session('mensaje') ?>
                  </div>
              <?php }  ?> 
=======
                <h3 class="card-title">Gestionar información de los usuarios creados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
>>>>>>> d1476fef7db13c36fbe91007409866aadda36ff2
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Persona</th>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Imagen</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($usuarios):?>
                      <?php foreach($usuarios as $user):
<<<<<<< HEAD
                        if($user['estado']==0):?>
                          <tr class="table-danger"> 
                            <td><?= $user['persona'];?></td>
                            <td><?= $user['usuario'];?></td>
                            <td><?= $user['rol_usuario'];?></td>
                            <td>
                              <a href="">Ver</a>
                            </td>
                            <td><?php echo $user['estado']==1 ? 'Activo' : 'Inactivo'  ?></td>
                            <td>
                              <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="fas fa-list"></i> Opciones
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="<?=base_url('editarUsuario/'.$user['id']);?>"><i class="fas fa-edit"></i> Editar</a></li>
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id']?>"><i class="fa-solid fa-key"></i> Reestablecer contraseña</a></li>
                                  <li><a class="dropdown-item" href="<?=base_url('borrarUsuario/'.$user['id']);?>"><i class="fas fa-trash-alt"></i> Borrar</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <?php else:?>
                          <tr> 
                            <td><?= $user['persona'];?></td>
                            <td><?= $user['usuario'];?></td>
                            <td><?= $user['rol_usuario'];?></td>
                            <td><?php echo $user['estado']==1 ? 'Activo' : 'Inactivo'  ?></td>
                            <td>
                              <a href="">Ver</a>
                            </td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-warning">Acciones</button>
                                <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  <li><a class="dropdown-item" href="<?=base_url('editarUsuario/'.$user['id']);?>"><i class="fas fa-edit"></i> Editar</a></li>
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id']?>"><i class="fas fa-key"></i> Reestablecer contraseña</a></li>
                                  <li><a class="dropdown-item" href="<?=base_url('eliminarUsuario/'.$user['id']);?>"><i class="fas fa-trash-alt"></i> Borrar</a></li>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php endif;?>
                      <?php endforeach; ?>
                    <?php endif; ?>
=======
                          if($user['estado']==0):
                            ?>
                            <tr class="table-danger"> 
                              <td><?= $user['usuario'];?></td>
                              <td>************</td>
                              <td><?= $user['rol'];?></td>
                              <td><?php echo $user['estado']==1 ? 'Activo' : 'Inactivo'  ?></td>
                              <td>
                                <div class="dropdown">
                                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-list"></i> Opciones
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?=base_url('editarUsuario/'.$user['id']);?>"><i class="fas fa-edit"></i> Editar</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id']?>"><i class="fa-solid fa-key"></i> Reestablecer contraseña</a></li>
                                    <li><a class="dropdown-item" href="<?=base_url('borrarUsuario/'.$user['id']);?>"><i class="fas fa-trash-alt"></i> Borrar</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                          <?php else:?>
                          <tr> 
                              <td><?= $user['usuario'];?></td>
                              <td>************</td>
                              <td><?= $user['rol'];?></td>
                              <td><?php echo $user['estado']==1 ? 'Activo' : 'Inactivo'  ?></td>
                              <td>
                                  <div class="dropdown">
                                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="fas fa-list"></i> Opciones
                                      </a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="<?=base_url('editarUsuario/'.$user['id']);?>"><i class="fas fa-edit"></i> Editar</a></li>
                                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?=$user['id']?>"><i class="fa-solid fa-key"></i> Reestablecer contraseña</a></li>
                                          <li><a class="dropdown-item" href="<?=base_url('borrarUsuario/'.$user['id']);?>"><i class="fas fa-trash-alt"></i> Borrar</a></li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                      <?php endif;?>
                    <?php endforeach; ?>
                  <?php endif; ?>

>>>>>>> d1476fef7db13c36fbe91007409866aadda36ff2
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
<?= $this->endsection() ?>