<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理員登入</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,.15);
        }
        h1 { text-align: center; color: #1a202c; font-size: 24px; margin-bottom: 8px; }
        .subtitle { text-align: center; color: #718096; font-size: 14px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label {
            display: block; margin-bottom: 6px; color: #4a5568;
            font-size: 14px; font-weight: 600;
        }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0;
            border-radius: 8px; font-size: 15px; transition: border .2s;
        }
        input[type="text"]:focus, input[type="password"]:focus { border-color: #667eea; outline: none; }
        .remember-group { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .remember-group label { margin-bottom: 0; font-weight: 400; }
        button {
            width: 100%; padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff; border: none; border-radius: 8px;
            font-size: 16px; font-weight: 600; cursor: pointer; transition: opacity .2s;
        }
        button:hover { opacity: .9; }
        .error {
            background: #fed7d7; color: #c53030; padding: 10px 14px;
            border-radius: 8px; font-size: 13px; margin-bottom: 20px;
        }
        .error ul { margin: 0 0 0 16px; }
        .logout-msg {
            background: #c6f6d5; color: #276749; padding: 10px 14px;
            border-radius: 8px; font-size: 13px; margin-bottom: 20px; text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1><?php echo e(config('app.name', '管理員')); ?></h1>
        <p class="subtitle">管理員登入</p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div class="logout-msg"><?php echo e(session('status')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="error">
                <ul>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <form method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="login">账号</label>
                <input type="text" id="login" name="login" value="<?php echo e(old('login')); ?>" required autocomplete="off" autofocus readonly onfocus="this.removeAttribute('readonly')">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
            </div>
            <div class="remember-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit">Sign in</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenicalst0re/xenicalst0re-v1/resources/views/admin/login.blade.php ENDPATH**/ ?>