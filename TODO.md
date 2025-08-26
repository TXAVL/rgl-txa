# TODO - Dự án Rút gọn Liên kết RGL TXA
- KEY VMWARE 17: MC60H-DWHD5-H80U9-6V85M-8280D
## 📋 Tổng quan

Dự án **RGL TXA** là một hệ thống rút gọn liên kết hiện đại, được xây dựng bằng **PHP 8.0+**, **MySQL 8.0+**, và **Bootstrap 5**, tích hợp các tính năng web tiên tiến để mang lại trải nghiệm người dùng mượt mà, an toàn và trực quan. Giao diện lấy cảm hứng từ GitHub, hỗ trợ **chế độ tối (dark mode)**, **responsive design** cho cả desktop và mobile, và tối ưu hóa hiệu suất với các công nghệ như caching và indexing cơ sở dữ liệu. Mọi thứ khi làm xong thì hãy đánh dấu X vào công việc đó để tránh lặp lại. Luôn nhớ khi gõ TLOGON ở trò chuyện thì tức chỗ đố sẽ dùng `Logging class` nha. 

### Mục tiêu chính:
- **Chức năng cốt lõi**: 
  - Rút gọn liên kết với slug tùy chỉnh (mặc định 5 ký tự).
  - Trang chuyển hướng mượt mà với đồng hồ đếm ngược và thanh tiến trình.
  - Tạo QR code tự động cho liên kết rút gọn.
  - Thống kê chi tiết (lượt nhấp, lượt xem, thiết bị, thời gian).
- **Bảo mật**: 
  - Đăng nhập/đăng ký với mã hóa **bcrypt**, xác thực hai yếu tố (2FA), WebAuthn (Passkey), và OAuth (Google, GitHub).
  - Bảo vệ chống SQL injection, XSS, CSRF.
  - Tích hợp Google reCAPTCHA v3 cho khách chưa đăng nhập.
- **Quản lý**: 
  - Dashboard người dùng để quản lý liên kết và token API.
  - Admin panel để quản lý người dùng, cấu hình hệ thống, và thống kê.
- **Hiệu suất**: 
  - Tối ưu hóa với caching (Redis/Memcached), database indexing, và query optimization.
- **Triển khai**: 
  - Hỗ trợ triển khai với Docker, tích hợp PWA, và bảo mật cao cấp.

### Quản lý Database:
- **Class Database**: Xử lý tất cả các thao tác liên quan đến cơ sở dữ liệu. Mọi thay đổi cấu trúc (thêm/xóa cột) phải được cập nhật trong class này.
- **File `migrate.php`**: Chứa hàm khởi tạo tự động tạo các bảng cần thiết (nếu chưa tồn tại) bằng câu lệnh SQL. Chỉ cần gọi hàm này để cập nhật cấu trúc bảng.

### Công nghệ sử dụng:
- **Backend**: PHP 8.0+, MySQL 8.0+, PHPMailer, WebAuthn, Redis/Memcached.
- **Frontend**: Bootstrap 5, Tailwind CSS, Chart.js, JavaScript (AJAX, Web Push API).
- **Tích hợp bên thứ ba**: Google reCAPTCHA v3, Google OAuth, GitHub OAuth, QR Code (`endroid/qr-code`).
- Bổ sung tính năng hỗ trợ đa ngôn ngữ nữa dùng file po nha.
---

### 📦 File `composer.json` đã có:

```json
{
    "name": "txa/rgl-txa",
    "description": "Hệ thống rút gọn liên kết hiện đại với giao diện GitHub-style",
    "type": "project",
    "require": {
        "php": ">=8.0",
        "ext-json": "*",
        "ext-pdo": "*",
        "lbuchs/webauthn": "^2.2",
        "phpmailer/phpmailer": "^6.10",
        "endroid/qr-code": "^4.8",
        "google/recaptcha": "^1.3"
    },
    "autoload": {
        "psr-4": {
            "TXA\\": "src/",
            "PHPMailer\\PHPMailer\\": "vendor/phpmailer/phpmailer/src/"
        }
    }
}
```
### **config.php** đã có:
và có file `api\index.php` như này:
# RGL API Tester (`api\index.php`) - Đây là phần để mà test các api có trên trang

## 📋 Mục đích

File `api\index.php` là công cụ giao diện web giúp kiểm thử nhanh các API chính của hệ thống Rút gọn Liên kết RGL TXA, hỗ trợ cả người dùng đã đăng nhập và khách (guest). Để họ biết cách gọi api qua code của họ.

---

## 🚀 Các chức năng chính

### 1. Test API rút gọn liên kết
- **Endpoint:** `POST /api/shorten.php`(**Trỏ tới cái api rút gọn kia**)
- Nhập URL cần rút gọn, tự động điền `User Token`.
- Gửi request và xem trực tiếp response JSON trả về.
- Có thể copy nhanh kết quả response.

### 2. Test API chuyển hướng
- **Endpoint:** `GET /{shortId}`
- Nhập shortId để kiểm tra chuyển hướng.
- Xem response header, status code, thời gian phản hồi.

### 3. Quick Test
- Các nút test nhanh các trường hợp phổ biến:
  - URL hợp lệ
  - URL không hợp lệ
  - URL rỗng
- Tự động điền dữ liệu mẫu và gửi request.

### 4. Quản lý User Token
- Nếu đã đăng nhập: tự động lấy token thật, readonly.
- Nếu là khách: sinh token ngẫu nhiên.
- Nút copy token tiện lợi.

### 5. Debug Information
- Hiển thị thông tin cấu hình hệ thống:
  - Debug mode, Site URL, Database, Short ID Length
  - User Status (Logged In/Guest), Token Type
  - PHP Version, Server, Thời gian hiện tại, Log Directory
### 6. Dashboard có hỗ trợ in thống kê dưới dạng pdf, in qr code của url bất kì.
Chia sẻ 1 link nào đó.
### 7. Có code mẫu và hỗ trợ language tab nhá.(bao gồm các code mẫu cho php,javascript, java, curl).
Nút copy rõ ràng.
---

## 🖥️ Giao diện
- Thiết kế với **Tailwind CSS** hiện đại, responsive.
- Có header, các card test API, quick test, debug info rõ ràng.
- Sử dụng icon FontAwesome.

---

## 📝 Hướng dẫn sử dụng nhanh
1. **Test rút gọn:**
   - Nhập URL cần rút gọn, kiểm tra/copy User Token nếu cần.
   - Nhấn "Send Request" để gửi request, xem kết quả trả về.
2. **Test chuyển hướng:**
   - Nhập shortId, nhấn "Test Redirect" để kiểm tra response.
3. **Quick Test:**
   - Nhấn các nút để test nhanh các trường hợp mẫu.
4. **Xem debug:**
   - Kéo xuống cuối trang để xem thông tin cấu hình và hệ thống.

---

## ⚠️ Lưu ý bảo mật
- Chỉ sử dụng cho mục đích kiểm thử, debug nội bộ.
- Token user thật chỉ hiển thị cho chính user đó khi đã đăng nhập.

## 📝 Danh sách TODO chi tiết

### 0. Giao diện cơ bản (index.php với Tailwind CSS)

- [ ] **GIAO DIỆN**
  - [ ] **index.php**:
    -  Thiết kế giao diện chính với **Tailwind CSS**, lấy cảm hứng từ GitHub: đơn giản, hiện đại, hỗ trợ **dark mode**.
    -  Gồm một **ô input** (text field) để nhập URL gốc và một **nút "Rút gọn"** (button) với hiệu ứng hover (màu nền thay đổi, ví dụ: `hover:bg-blue-600`).
    -  Hiển thị **toast notification** (sử dụng Tailwind CSS và JavaScript) cho các trạng thái: thành công (liên kết rút gọn), lỗi (URL không hợp lệ), hoặc yêu cầu xác minh reCAPTCHA.
    -  Mô tả chi tiết về trang này kèm cả faq dropdown nữa, dùng card info bo góc, svg icon nha.
    -  Sau khi rút gọn, hiển thị:
      - Liên kết ngắn (ví dụ: `domain.com/?t=abc12`).
      - Link gốc với hậu tố (ví dụ: `https://example.com?txa=abc12`).
      - **QR code** (tạo bằng `endroid/qr-code`) cho liên kết ngắn.
      - Nút **sao chép liên kết** (sử dụng Clipboard API).
    -  Responsive design với Tailwind CSS (hỗ trợ mobile, tablet, desktop).
  - [ ] **redirect.php**:
    -  Trang chuyển hướng đẹp, sử dụng **Bootstrap 5** và **Tailwind CSS**.
    -  Hiển thị:
      - **Đồng hồ đếm ngược** (mặc định 10 giây, cấu hình qua `COUNTDOWN_SEC`) và **thanh tiến trình** (progress bar) để thể hiện thời gian chờ.
      - Sử dụng **cURL** để fetch trang đích trước, lấy **tiêu đề trang** (title) và **ảnh chụp nhanh** (nếu có thể, sử dụng thư viện như Browsershot hoặc đơn giản là favicon).
      - Nút "Chuyển hướng ngay" để bỏ qua đếm ngược.
      - Responsive và hỗ trợ dark mode.
  - [ ] **api/shorten.php**:
    -  API endpoint mà `index.php` gọi đến để xử lý rút gọn liên kết (sử dụng AJAX POST).
    -  Xử lý validation URL, kiểm tra domain cho phép (`ALLOWED_DOMAINS`), và tạo slug ngắn (độ dài từ `LENGTH_SHORTEN`).
    -  Trả về JSON với liên kết ngắn, QR code base64 (nếu cần), và thông báo lỗi.

- [ ] **SMOOTH URL (.htaccess file)**
  - [ ] **.htaccess** để rewrite URL chuyển hướng thành dạng ngắn: `domain.com/?t=slug`.
  - [ ] Ẩn đuôi file PHP và sử dụng đường dẫn tuyệt đối (ví dụ: thay `<script src='../js/loading.js'>` bằng `<script src="<?php echo SITE_URL; ?>/js/loading.js">`).
  - [ ] Rewrite URL để ẩn đuôi PHP và làm đẹp thanh địa chỉ:
    | URL Thay Đổi     | URL Gốc                  |
    |------------------|--------------------------|
    | users/login      | auth/login.php           |
    | users/forgot     | auth/forgot-password.php |
    | users/reg        | auth/register.php        |
    | users/logout     | auth/logout.php          |
    | users/verify?txa=token| auth/verify.php?txa=token     |
    | users/reset?txa=token | auth/reset-password.php?txa=token |
    | ?t=abc12         | redirect.php?t=abc12     |
    | docs/api         | api/index.php            |

- [ ] **Cấu trúc database**
  - [ ] **Class Database**: Thực hiện kết nối PDO và các hàm CRUD. Bao gồm hàm migrate tự động tạo bảng.
  - [ ] Logo nằm ở `img/logo.png`.
  - [ ] Chỉnh để logo hiển thị kèm vào các email đc gửi đi và logo hiển thị ở file header vs các trang dăng kí, dăng nhập, quên mật khẩu, verify email.
  - [ ] Đã chỉnh favicon cho index, giờ đưa vào mọi trang khác hoặc tạo file tổng quát để import.
  - [ ] Chỉnh `site.webmanifest` để biến web thành PWA. Logo đã sẵn có.
  - [ ] Custom trang 404, 403 với giao diện hacker ngầu, trang 404 có đồng hồ đếm ngược 5s về trang chủ. Thông báo hay hơn, in URL hiện tại trên 404. Chỉnh .htaccess để hiển thị nội dung lỗi custom (không redirect).

- [ ] **Logging và Debug UI**
  - [ ] Tích hợp Logger class vào toàn bộ hệ thống.
  - [ ] Tất cả log đó lưu vào 1 file ở folder logs(nhưng chỉ lưu khi mà flag `DEBUG_MODE` đc bật trong config) và có thể xóa hoặc xem log bằng 1 file php khác.
Xóa là xóa theo thời gian.

### 1. 🔐 Hệ thống xác thực và đăng nhập

- [ ] **Tích hợp đăng nhập và đăng ký tài khoản**
  - [ ] Tạo form đăng nhập/đăng ký với Tailwind CSS.
  - [ ] Mã hóa mật khẩu an toàn bằng bcrypt.
  - [ ] Xác thực biểu mẫu (validation).
  - [ ] Xác nhận email cho đăng ký.
  - [ ] Quản lý phiên (session management).
  - [ ] Tạo file `auth/login.php`, `auth/register.php`, `auth/logout.php`.
  - [ ] Tạo file `auth/verify.php`, `auth/forgot-password.php`, `auth/reset-password.php`.
  - [ ] Tạo class `Auth` với đầy đủ chức năng.
  - [ ] Cập nhật database schema cho users và sessions.
  - [ ] Đặt thời gian hết hạn cho các link đặt lại mật khẩu và verify email để nêu hết hạn mà họ ms vô link đó thì báo hết hạn còn mà link đã đổi đc mật khẩu hoặc dùng để xác minh xong rồi(sau khi cập nhật mật khẩu/xác minh email thành công tự xóa cái token đó di) mà họ vẫn vô lại thì báo lỗi ra ngay.
  - [ ] Tích hợp vào trang chủ với menu user.
  - [ ] Thay đổi để gửi email bằng PHPMailer. Cấu hình mail:
    - SMTP server: Gmail.
    - Username: txafile@gmail.com.
    - Password: neqd axon hwxf gecc.
    - Lưu cấu hình ở `config.php`.
  - [ ] Thay đổi thông báo, nâng cấp giao diện cho email xác minh/đặt lại mật khẩu, và footer.
  - [ ] Bật UTF-8 cho mail để tránh lỗi font, thiết lập tổng quát ở file chính.

- [ ] **Dark Mode toàn hệ thống**
  - [ ] Thiết kế theo GitHub dark theme.
  - [ ] Toggle chế độ sáng/tối.
  - [ ] Lưu preference trong localStorage.
  - [ ] Tạo file `css/app.css`.

- [ ] **Responsive Design toàn hệ thống**
  - [ ] Tối ưu cho mobile.
  - [ ] Menu hamburger cho mobile.
  - [ ] Tailwind CSS responsive classes.

- [ ] **Loading States toàn hệ thống**
  - [ ] Progress indicators (spinners) cho tất cả form auth.
  - [ ] Smooth transitions (fade in/out) cho tất cả thông báo bao gồm cả thông báo trên các trang auth(login, register, forgot-password, reset-password).
  - [ ] AJAX form submission cho tất cả trang auth (login, register, forgot-password, reset-password).
  - [ ] AJAX để tránh phải reload lại các trang.

- [ ] **OAuth Integration**
  - [ ] Đăng nhập qua Google OAuth(callback: callback/gg.php).
  - [ ] Đăng nhập qua GitHub OAuth(callback: callback/git.php).
  - [ ] Tạo file `auth/oauth.php` để trang đó lấy access token và link ủy quyền nhận method để biết họ login bằng gg hay github.
  - [ ] htaccess edit lại để trỏ tới trang auth/oauth.php?method=(gg/github) thì đổi sang oauth/gg hoặc oauth/github.
  - [ ] bổ sung thêm phần đăng kí bằng 2 cái này nhưng sau khi họ đc ủy quyền trở laij từ github/gg thì kiểm tra xem tồn tại hay chưa nếu rồi thì báo lỗi là đã đăng kí tài khoản ,,,,,,,,,(github.gg).

- [ ] **Tính năng Passkey (WebAuthn)**
  - [ ] Tích hợp WebAuthn API.
  - [ ] Tạo trang xác thực với tùy chọn Passkey.
  - [ ] Hỗ trợ khóa phần cứng để đăng nhập không cần mật khẩu.
  - [ ] Tạo file `auth/passkey.php`.

- [ ] **Thêm tinh chỉnh template email tùy chỉnh**
  - [ ] Folder `templates/` chứa các template email hoàn chỉnh.
  - [ ] Chỉnh để đọc template từ folder này trong file gửi mail, thay thế biến động.
  - [ ] Biến có sẵn: `{username}`, `{date}` (ngày hiện tại), `{time}` (HH:mm dd/MM/YY), `{site_name}`, `{verification_link}`, `{reset_link}`, `{time_expried}` = time hết hạn của link đó đc cấu hình trong config.
  - [ ] Chỉnh README để hướng dẫn chỉnh template và giải thích biến.
  - [ ] Thêm trang đẻ họ xẻm các biến và giá trị có sẵn của nó.

- [ ] **Xác thực hai yếu tố (2FA)**
  - [ ] Tích hợp TOTP (Time-based One-Time Password).
  - [ ] Tạo trang nhập mã 2FA tương tự GitHub.
  - [ ] Dropdown "Thêm tùy chọn" với Passkey, GitHub, Mã khôi phục.
  - [ ] Tạo file `auth/2fa.php`, `auth/2fa-setup.php`.

### 2. 🔗 Rút gọn liên kết và thống kê

- [ ] **Tích hợp rút gọn liên kết theo người dùng**
  - [ ] Cập nhật `LinkShortener` class để hỗ trợ user_id.
  - [ ] Cập nhật API `api/shorten.php` để xử lý user_id.
  - [ ] Cập nhật trang chủ để sử dụng API mới.
  - [ ] Liên kết short links với user_id trong database.
  - [ ] Dashboard người dùng để quản lý liên kết.
  - [ ] Tạo file `dashboard/index.php` với đầy đủ chức năng.
  - [ ] **Hệ thống user_token** - Tạo và quản lý token cho API authentication.
  - [ ] **Cập nhật database** - Thêm cột user_token vào bảng users.
  - [ ] **Dashboard token management** - Hiển thị và tạo mới user_token.

- [ ] **Thống kê liên kết cơ bản**
  - [ ] Theo dõi lượt nhấp, lượt xem.
  - [ ] Thống kê tổng quan cho người dùng.
  - [ ] Liên kết gần đây và phổ biến nhất.
  - [ ] Tạo, xóa, cập nhật liên kết từ dashboard.

- [ ] **QR CODE CHO LINK**
  - [ ] Tự động tạo và hiển thị QR code cho link rút gọn ngay sau khi rút gọn.
  - [ ] Ở dashboard thêm mục menu hiển thị các mã QR cho các link nếu có.
  - [ ] Cập nhật lại cấu trúc Database.

- [ ] **WEB PWA**
  - [ ] Phát triển WEBPWA.

- [ ] **reCAPTCHA v2**
  - [ ] Tích hợp Google reCAPTCHA v2 cho khách khi rút gọn trên trang chủ (chỉ bật nếu chưa login). Khi login thì bỏ qua.
  - [ ] Lưu cấu hình ở config:
    ```php
    define('RECAPTCHA_SITE_KEY', '6LdOi58rAAAAACIdw-X4uQK2tGLiOnWfS9U2Mq35');
    define('RECAPTCHA_SECRET_KEY', '6LdOi58rAAAAALhfzqj2ykaUGrx_8M9oltdsq4UE');
    ```

- [ ] **Thống kê chi tiết với biểu đồ**
  - [ ] Biểu đồ thống kê với Chart.js.
  - [ ] Tạo file `dashboard/stats.php`.
  - [ ] Biểu đồ theo thời gian, địa điểm, thiết bị.

### 3. 👨‍💼 Admin Panel

- [ ] **Chức năng admin cơ bản**
  - [ ] Quản lý liên kết.
  - [ ] Xem thống kê trang web.
  - [ ] Bộ lọc thời gian: 1h, 3h, 1 ngày, 3 ngày, 7 ngày, 1 tháng, toàn thời gian.
  - [ ] Tạo file `admin/index.php`.

- [ ] **Giao diện admin với Tailwind CSS**
  - [ ] Menu admin với biểu tượng hamburger.
  - [ ] Menu responsive trên mobile và desktop.
  - [ ] Tên trang web trong menu.
  - [ ] Theme admin màu đỏ.
  - [ ] Navigator panel riêng cho admin.

- [ ] **Quản lý người dùng và cấu hình**
  - [ ] Quản lý người dùng.
  - [ ] Cấu hình trang web.
  - [ ] Cài đặt email và bảo mật.
  - [ ] Toggle trạng thái user.
  - [ ] Tạo file `admin/users.php`, `admin/settings.php`.

- [ ] **Hệ thống admin roles và export/import**
  - [ ] Thêm cột is_admin vào database.
  - [ ] Kiểm tra quyền admin với Auth::isAdmin().
  - [ ] Toggle quyền admin cho users.
  - [ ] Không cho phép xóa quyền admin của chính mình.
  - [ ] Export users ra CSV và JSON (tải xuống dạng blob URL).
  - [ ] Import users từ CSV và JSON.
  - [ ] Ghi log hoạt động admin.
  - [ ] Tạo class DataManager để xử lý export/import.
  - [ ] Bảo vệ thư mục exports.

### 4. 🛡️ Bảo mật và phát hiện

- [ ] **Phát hiện AdBlock**
  - [ ] JavaScript để kiểm tra trình chặn quảng cáo.
  - [ ] Hiển thị thông báo lịch sự nếu phát hiện.
  - [ ] Tạo file `js/adblock-detector.js`.
  - [ ] Mã hóa file này và chặn truy cập trực tiếp.

### 5. 📊 Thống kê và API

- [ ] **Thống kê footer**
  - [ ] Hiển thị số liệu cơ bản trên trang chủ.
  - [ ] Card Bootstrap đẹp mắt.
  - [ ] Liên kết đến trang thống kê chi tiết.
  - [ ] Cập nhật `index.php` footer.

- [ ] **API RESTful**
  - [ ] Endpoint tạo liên kết rút gọn.
  - [ ] Endpoint lấy thông tin liên kết.
  - [ ] Xác thực bằng token API.

- [ ] **Trang docs API**
  - [ ] Hướng dẫn sử dụng API.
  - [ ] Ví dụ code.
  - [ ] Liên kết từ trang API.
  - [ ] Tạo file `docs/api.php`.

### 6. 👤 Trang cá nhân người dùng

- [ ] **Giao diện hồ sơ GitHub-style**
  - [ ] Thanh menu bên trái với biểu tượng.
  - [ ] Các phần: Hồ sơ công khai, Tài khoản, Giao diện, Trợ năng, Thông báo, Truy cập.
  - [ ] Lịch sử đăng nhập(Xem các thiết bị/log đăng nhập), quản lí phiên qua bảng user_sessions.
  - [ ] Tạo file `profile/index.php`.

- [ ] **Thanh điều hướng trên cùng**
  - [ ] Biểu tượng Octocat.
  - [ ] Nhãn "Bảng điều khiển".
  - [ ] Biểu tượng tìm kiếm, thông báo, ảnh hồ sơ.
  - [ ] Tạo file `profile/layout.php` làm thanh nav.

- [ ] **Khu vực nội dung chính**
  - [ ] Trường Tên (có thể chỉnh sửa).
  - [ ] Ảnh hồ sơ (upload/chỉnh sửa hình tròn).
  - [ ] Email công khai (dropdown).
  - [ ] Tiểu sử (textarea với @mention).
  - [ ] Đại từ (dropdown).

- [ ] **Bổ sung bookmarklet hỗ trợ rút gọn nhanh trang hiện tại và hiển thị modal thông báo:**

    ```javascript
    javascript:void(function(){
      if(document.getElementById('txa-shorten-box')) return;
      var e=document.createElement('script');
      e.src='<?php echo asset('js/bookmarklet.js'); ?>?v=(token_vbookmark)';
      document.body.appendChild(e);
    })();
    ```

    >  Giao diện modal (render bởi `bookmarklet.js`) gồm:
    - Logo TXA
    - Tiêu đề `🎉 URL đã được rút gọn!`
    - Input chứa URL đã rút gọn (disabled)
    - Nút "📋 Copy URL"
    - Nút đóng `×`
    - Footer hiển thị thời gian thực `HH:mm:ss dd/MM/yy - Script by TXA`
    - Animation: `fadeIn` khi hiển thị và `fadeOut` khi đóng
    - Dừng `setInterval` sau khi đóng modal để tránh lỗi

    >  Chức năng:
    - Khi click nút copy: sao chép link rút gọn vào clipboard và hiển thị  đã copy trong 2s.
    - Modal chỉ được hiển thị nếu `vbookmark` hợp lệ và tìm thấy user tương ứng trong SQL DATABASE.
    - Nếu không hợp lệ → `403` + thông báo lỗi.
  - FIle bookmarklet.js: 
     - [ ] Kiểm tra tham số `v` là chuỗi 16 ký tự.
    - [ ] Truy xuất `username` từ SQLite theo `vbookmark`.
    - [ ] Nếu không tồn tại → trả về lỗi.
    - [ ] Nếu tồn tại → render JS hiển thị modal như mô tả trên.
    - [ ] Dừng interval khi đóng modal (`clearInterval`).
    - [ ] Logo: `<?php echo asset('img/logo.png'); ?>`
    - [ ] Favicon (không cần xử lý thêm vì không có ảnh hưởng trong JS động).

- [ ] **Tạo vbookmark cho mỗi user sau khi đăng ký:**
    - Cột `vbookmark` (16 ký tự hex, random_bytes)
    - Nếu đã có → không tạo lại.
    - Gắn kèm `vbookmark` này vào JS bookmarklet riêng cho từng người dùng.
    - Vô thẳng link direct bookmarklet trả về rỗng chỉ cho vô từ fetch thôi.
    - **Nếu người dùng bấm trực tiếp vào nút bookmarklet từ trang bookmarklet đó (không dùng bookmarklet) thì chặn không cho hoạt động.**
    - Logo: `<?php echo asset('img/logo.png'); ?>`
    - Favicon: `<?php echo asset('favicon.ico'); ?>`
    2 cái logo và favicon cho thằng modal vs lại gắn ico vào cái bookmarklet.

## PROFILE PAGE:
-nav con bên trái cho profile page(tối ưu cách hiển thị của nó trên desktop và mobile). Đang ở trang nào trong profile thì cái dòng đó sẽ đc thêm class active.
ở trên đầu thêm hiện đường dẫn dạng:
Dashboard>Profile>Notifications(mỗi cái đều có link đầy đủ)


- [ ] Integrate notification settings from "Cài đặt thông báo" interface trong trang profile:
  - [ ] Enable "Thông báo qua email" with sub-options (cannot be disabled):
    - [ ] "Thông báo chung về hoạt động của tài khoản nhưu đăn nhập, đăng kí" (default: ON, relates to account activities)
    - [ ] "Cảnh báo bảo mật
Thông báo khi có đăng nhập từ thiết bị mới (default: ON, relates to account activities) - tắt thì mọi thiết bị mới/lạ đăng nhập vô k còn thông báo qua email nx,
  - [ ] Add "Email marketing" option:
    - [ ] "Nhận thông tin về tin nhắn và cập nhật" (default: OFF)
  - [ ] Implement "Thông báo đẩy" feature:
    - [ ] "Thông báo trên thiết bị" (default: ON) - bật thì nó sẽ gửi các thông báo như trên qua cả thông báo đẩy(gửi thông báo k cần vô trang chỉ càn mở trình duyệt).
    - [ ] Add "Bật thông báo" button
    - [ ] Add "Lưu cài đặt" button

- [ ] Develop "Cài đặt giao diện" interface under Dashboard > Profile > Appearance:
  - [ ] Create theme selection:
    - [ ] "Sáng" (default color: yellow)
    - [ ] "Tối" (default color: gray)
    - [ ] "Tùy chỉnh" (default color: light purple)
  - [ ] Add language selection dropdown:
    - [ ] "Tiếng Việt (Vietnamese)" (VN)
    - [ ] "English (Tiếng Anh)" (US)
  - [ ] Implement time zone selection:
    - [ ] Default: "Asia/Ho Chi Minh (GMT+7)"
  - [ ] Add "Lưu cài đặt" button
- [ ] Thêm quản lí/xóa session

### 7. 🔄 Tính năng nâng cao

- [ ] **Sao lưu và khôi phục dữ liệu**
  - [ ] Tải xuống tệp sao lưu (JSON/CSV).
  - [ ] Khôi phục dữ liệu từ tệp sao lưu.
  - [ ] Tạo file `backup/export.php`, `backup/import.php`.

- [ ] Tích hợp Bootstrap 5 vào trang users và trang admin.

- [ ] **Thông báo đẩy (Push Notifications)**
  - [ ] Tích hợp Web Push API.
  - [ ] Thông báo khi có lượt nhấp mới.
  - [ ] Thông báo khi truy cập từ thiết bị lạ.
  - [ ] Tạo file `notifications/push.php`.

- [ ] **Chia sẻ mạng xã hội**
  - [ ] Nút chia sẻ Facebook, Twitter, WhatsApp.
  - [ ] Thiết kế đẹp mắt với Bootstrap.
  - [ ] Tạo file `social/share.php`.

- [ ] **Quản lý danh sách yêu thích**
  - [ ] Đánh dấu liên kết quan trọng.
  - [ ] Truy cập nhanh từ trang cá nhân.
  - [ ] Tạo file `favorites/index.php`.

### 8. 🗄️ Database và Backend

- [ ] **Cập nhật cấu trúc database**
  - [ ] Bảng cho 2FA, OAuth, Passkey.
  - [ ] Bảng cho thống kê chi tiết.
  - [ ] Bảng cho cấu hình admin.
  - [ ] Cập nhật `database.sql`.

- [ ] **Tối ưu hóa performance**
  - [ ] Caching với Redis/Memcached.
  - [ ] Database indexing.
  - [ ] Query optimization.

### 9. 🧪 Testing và Deployment

- [ ] **Unit Testing**
  - [ ] PHPUnit tests.
  - [ ] API endpoint testing.
  - [ ] Tạo thư mục `tests/`.

- [ ] **Security Testing**
  - [ ] SQL injection prevention.
  - [ ] XSS protection.
  - [ ] CSRF protection (tạm thời tắt).

- [ ] **Deployment**
  - [ ] Docker configuration.
  - [ ] Environment variables.
  - [ ] Production optimization.

## 🎯 Ưu tiên thực hiện

0->1->2->4->3->5->6->8->7->9.

## 📝 Ghi chú

- Sử dụng PHP 7.4 cho các tính năng hiện đại.
- Bootstrap 5 cho UI/UX nhất quán.
- MySQL cho database.
- Chart.js cho biểu đồ.
- WebAuthn API cho Passkey.
- Web Push API cho notifications. 

---

##  Module X: Installation Wizard System

### 📦 Hệ thống cài đặt tự động với giao diện đẹp

**Tổng quan:** Tạo một Installation Wizard hoàn chỉnh cho phép users dễ dàng cài đặt RGL TXA trên hosting mà không cần kỹ thuật. Wizard có giao diện professional, progress tracking, error handling, và support cho migration từ version cũ.

#### 🎯 **Core Requirements:**

**1. Multi-Step Installation Interface:**
- [ ] **Welcome Step (Step 0)**: Giới thiệu và hướng dẫn cơ bản
- [ ] **Requirements Check (Step 1)**: Kiểm tra PHP version, extensions, file permissions
- [ ] **Database Configuration (Step 2)**: Nhập thông tin DB với test connection
- [ ] **Site Configuration (Step 3)**: Cấu hình tên site, URL, email, timezone
- [ ] **Admin User Creation (Step 4)**: Tạo tài khoản admin đầu tiên
- [ ] **Final Installation (Step 5)**: Chạy migration, tạo config.php, cleanup

**2. Visual Progress System:**
- [ ] **Progress Bar**: Thanh tiến trình với percentage (0% → 100%)
- [ ] **Step Indicators**: Visual indicators cho từng step (pending → active → completed)
- [ ] **Breadcrumb Navigation**: Cho phép quay lại steps đã hoàn thành
- [ ] **Real-time Feedback**: Status updates cho từng action

**3. Smart Installation Logic:**
- [ ] **Auto-redirect**: Redirect tất cả pages về installer nếu chưa cài đặt
- [ ] **Progress Persistence**: Lưu progress cho mỗi step, có thể resume nếu interrupted
- [ ] **Data Validation**: Validate tất cả inputs với clear error messages
- [ ] **AJAX Installation**: Final step chạy qua AJAX, không reload page

#### 🔧 **Technical Implementation:**

**1. File Structure:**
```
install/
├── index.php                 # Main installer router
├── InstallationManager.php   # Progress & session management
├── steps/
│   ├── welcome.php           # Step 0: Welcome
│   ├── requirements.php      # Step 1: System requirements
│   ├── database.php          # Step 2: Database config
│   ├── site-config.php       # Step 3: Site settings
│   ├── admin-user.php        # Step 4: Admin creation
│   ├── final.php             # Step 5: Installation
│   └── migration.php         # Special: Migration from old version
└── api/
    └── install.php           # AJAX API for final installation
```

**2. Core Classes:**
- [ ] **InstallationManager**: Session management, progress tracking, logging
- [ ] **DatabaseMigrations**: Version control, schema management, auto-migration
- [ ] **Config Template System**: Generate config.php từ template với placeholders

**3. Smart Features:**
- [ ] **Auto-detection**: Detect existing installations, migration requirements
- [ ] **Schema Migration**: Auto-add missing columns to existing tables
- [ ] **Backup System**: Backup configs trước khi upgrade
- [ ] **Error Recovery**: Debug tools, manual navigation, emergency reset

#### 🎨 **UI/UX Requirements:**

**1. Professional Design:**
- [ ] **Clean Interface**: Modern design với Tailwind CSS
- [ ] **Responsive Layout**: Works perfectly trên desktop và mobile
- [ ] **Logo Integration**: Site logo và branding throughout
- [ ] **Dark Mode Support**: Consistent với main application theme

**2. User Experience:**
- [ ] **Step-by-step Guidance**: Clear instructions cho mỗi step
- [ ] **Input Validation**: Real-time validation với helpful error messages
- [ ] **Auto-fill**: Smart defaults và auto-detection where possible
- [ ] **Progress Persistence**: Users có thể pause và resume installation

**3. Error Handling:**
- [ ] **Graceful Degradation**: Handle hosting limitations (InfinityFree, etc.)
- [ ] **Debug Information**: Comprehensive debug panel cho troubleshooting
- [ ] **Recovery Options**: Emergency tools, manual navigation, reset capabilities
- [ ] **Hosting-specific Warnings**: Auto-detect và explain hosting restrictions

#### 📱 **Advanced Features:**

**1. Migration System:**
- [ ] **Version Detection**: Auto-detect khi cần upgrade from old version
- [ ] **Config Preservation**: Keep existing settings during upgrade
- [ ] **Schema Upgrades**: Auto-add missing DB columns/tables
- [ ] **Backward Compatibility**: Support migration từ earlier versions

**2. Security & Reliability:**
- [ ] **Session Security**: Secure session handling với timeout
- [ ] **Input Sanitization**: All inputs properly sanitized
- [ ] **Database Security**: Prepared statements, injection prevention
- [ ] **File Permissions**: Check và set proper file permissions

**3. Developer Experience:**
- [ ] **Debug Tools**: Comprehensive debugging information
- [ ] **Logging System**: Detailed logs cho troubleshooting
- [ ] **Emergency Tools**: Database reset, manual configuration
- [ ] **Testing Utilities**: Tools để test migration và schema

#### 🛠️ **Implementation Details:**

**1. URL Rewriting (.htaccess):**
```apache
# Installation wizard routes
RewriteRule ^setup/?$ install/index.php [NC,L]
RewriteRule ^setup/step/([0-9]+)/?$ install/index.php?step=$1 [NC,L]
RewriteRule ^setup/api/(.*)$ install/api/$1 [NC,L]
```

**2. Auto-redirect Logic (install-check.php):**
```php
// Include ở top của every PHP file
require_once 'install-check.php';

// Auto-redirect tới installer nếu chưa cài đặt
checkInstallationAndRedirect();
```

**3. Progress Management:**
```php
// Save progress cho mỗi step
InstallationManager::saveProgress($stepNumber, $data, $status);

// Check current step
$currentStep = InstallationManager::getCurrentStep();

// Get step data
$stepData = InstallationManager::getStepData($stepNumber);
```

**4. AJAX Installation API:**
```javascript
// Final installation qua AJAX
async function performInstallation() {
    const response = await fetch('api/install.php', {
        method: 'POST',
        body: JSON.stringify({ action: 'install' })
    });
    // Handle progress updates và completion
}
```

#### 🎯 **Success Criteria:**

**1. Functional Requirements:**
- [ ] **Zero-technical-knowledge Installation**: Anyone có thể install without technical skills
- [ ] **One-click Database Setup**: Auto-create tables, indexes, initial data
- [ ] **Config Generation**: Generate complete config.php từ user inputs
- [ ] **Admin Account Creation**: Ready-to-use admin account sau installation

**2. Technical Requirements:**
- [ ] **Cross-hosting Compatibility**: Works trên shared hosting, VPS, cloud
- [ ] **PHP 8.x Support**: Compatible với modern PHP versions
- [ ] **MySQL Compatibility**: Works với MySQL 5.7+ và MariaDB
- [ ] **Error Resilience**: Graceful handling của hosting limitations

**3. User Experience:**
- [ ] **< 5 minutes Installation**: Complete setup trong under 5 minutes
- [ ] **Clear Progress Indication**: Users always know where they are
- [ ] **Recovery from Errors**: Easy troubleshooting và recovery options
- [ ] **Professional Appearance**: Installer reflects quality của main application

#### 🚀 **Future Enhancements:**

**1. Advanced Features:**
- [ ] **Multi-language Support**: Support multiple languages trong installer
- [ ] **Advanced Config Options**: OAuth setup, email configuration trong installer
- [ ] **Backup Integration**: Auto-backup existing data before upgrade
- [ ] **Environment Detection**: Auto-configure settings based on hosting environment

**2. Developer Tools:**
- [ ] **CLI Installation**: Command-line version cho developers
- [ ] **Docker Integration**: One-command Docker setup
- [ ] **Automated Testing**: Test suite cho installation process
- [ ] **Migration Testing**: Tools để test upgrades từ different versions

---

## 📄 Tóm tắt code
- Sử dụng PHP để lấy thông tin user, token, cấu hình.
- Giao diện và logic test API hoàn toàn bằng HTML + Tailwind CSS + JavaScript thuần.
- Các hàm JS hỗ trợ gửi request, copy kết quả, sinh token, test nhanh.
- Installation Wizard sử dụng modern PHP patterns với AJAX, progressive enhancement, và responsive design. 