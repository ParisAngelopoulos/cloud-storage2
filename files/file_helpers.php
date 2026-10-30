<?php
// Icon and readable size for a file in the lists
function file_icon($name) {
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'], true)) return ['🖼️', 'bg-amber-50'];
    if ($ext === 'pdf') return ['📕', 'bg-red-50'];
    if ($ext === 'docx') return ['📘', 'bg-blue-50'];
    return ['📄', 'bg-gray-50'];
}

function file_size($path) {
    if (!is_file($path)) return '';
    $bytes = filesize($path);
    return $bytes >= 1048576 ? round($bytes / 1048576, 1) . ' MB' : max(1, round($bytes / 1024)) . ' KB';
}
