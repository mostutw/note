<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- boostrap -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- jquery -->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <!-- custom -->
  <link rel="stylesheet" type="text/css" href="css/resume.css">

  <title>人事資料表 | 整技科技股份有限公司</title>
</head>

<body>
  <div class="container full">
    <div class="row c-form-page">
      <form role="form" action="index.html" method="get">
        <div>
          <img src="img/banner.png" class="c-img-banner" alt="">
        </div>
        <div class="col-sm-12 c-form-legend">
          <p class="h2 text-center">整技科技 人事資料表</p>
        </div>
        <div class="col-sm-12 form-column">
          <!-- 應徵資訊 -->
          <div class="row">
            <div class="col-md-2 col-sm-12 c-img-circle">
              <img src="img/user-photo.png" class="c-circle" id="userPhoto" name="userPhoto" >
              <input type="file" id="uploadUserPhoto" name="uploadUserPhoto" accept="image/*" onchange="readURL(this);" style="display:none" >
            </div>
            <div class="col-md-10">
              <div class="form-group col-md-4">
                <label for="dept">應徵部門</label>
                <input type="text" id="dept" name="dept" class="form-control" placeholder="研發部">
              </div>
              <div class="form-group col-md-4">
                <label for="job">應徵職位</label>
                <input type="text" id="job" name="job" class="form-control" placeholder="主任工程師">
              </div>
              <div class="form-group col-md-4">
                <label for="workDate">最快可上班日期</label>
                <input type="date" id="workDate" name="workDate" class="form-control" value="">
              </div>
              <div class="form-group col-md-4">
                <label for="salary">期望待遇</label>
                <input type="number" id="salary" name="salary" class="form-control" placeholder="65000">
              </div>
              <div class="form-group col-md-4">
                <label for="lowSalary">最低可接受月薪</label>
                <input type="number" id="lowSalary" name="lowSalary" class="form-control" placeholder="60000">
              </div>
            </div>
          </div>
          <!-- 個人基本資料 -->
          <p class="h3">基本資料</p>
          <hr>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="chineseName">中文姓名</label>
              <input type="text" id="chineseName" name="chineseName" class="form-control" placeholder="陳米米">
            </div>
            <div class="form-group col-md-4">
              <label for="englishName">英文姓名</label>
              <input type="text" id="englishName" name="englishName" class="form-control" placeholder="Mi Chen">
            </div>
            <div class="form-group col-md-2">
              <label for="sex" class="select">性別</label>
              <select class="form-control form-select" id="sex">
                <option>男</option>
                <option>女</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="marry">婚姻</label>
              <select class="form-control form-select" id="">
                <option>單身</option>
                <option>已婚</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="id">身份證</label>
              <input type="text" id="id" name="id" class="form-control" placeholder="H122900100">
            </div>
            <div class="form-group col-md-4">
              <label for="birthday">出生年月日</label>
              <input type="date" id="birthday" name="birthday" class="form-control" value="">
            </div>
            <div class="form-group col-md-4">
              <label for="nativePlace">出生地</label>
              <input type="text" id="nativePlace" name="nativePlace" class="form-control" placeholder="臺灣省桃園縣">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="height">身高(cm)</label>
              <input type="number" id="height" name="height" class="form-control" placeholder="180">
            </div>
            <div class="form-group col-md-2">
              <label for="weight">體重(kg)</label>
              <input type="number" id="weight" name="weight" class="form-control" placeholder="80">
            </div>
            <div class="form-group col-md-2">
              <label for="bloodType">血型</label>
              <input type="text" id="bloodType" name="bloodType" class="form-control" placeholder="A">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="colorPerception">辨色力</label>
              <select class="form-control form-select" id="colorPerception">
                <option>正常</option>
                <option>色盲</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="visionLeft">視力(左)</label>
              <input type="number" id="visionLeft" name="visionLeft" class="form-control" placeholder="1.0">
            </div>
            <div class="form-group col-md-2">
              <label for="visionRight">視力(右)</label>
              <input type="number" id="visionRight" name="visionRight" class="form-control" placeholder="1.0">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="disability">身心障礙</label>
              <select class="form-control form-select" id="disability">
                <option value="0">否</option>
                <option value="1">是</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="disabilityType">類別</label>
              <input type="text" id="disabilityType" name="disabilityType" class="form-control" placeholder="聽覺障礙"
                disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="disabilityLevel">程度</label>
              <input type="text" id="disabilityLevel" name="disabilityLevel" class="form-control" placeholder="輕度"
                disabled>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="military">兵役狀況</label>
              <select class="form-control form-select" id="military">
                <option>請選擇</option>
                <option value="1">役畢</option>
                <option value="2">未役</option>
                <option value="3">待役</option>
                <option value="4">免役</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="militaryDate">退伍日期</label>
              <input type="date" id="militaryDate" name="militaryDate" class="form-control" value="">
            </div>
            <!-- <div class="form-group col-md-4">
            <label for="soldierType">軍種</label>
            <select class="form-control form-select" id="">
              <option>請選擇</option>
              <option>陸軍</option>
              <option>海軍</option>
              <option>海軍陸戰隊</option>
              <option>空軍</option>
              <option>憲兵</option>
              <option>其他兵科</option>
            </select>
          </div> -->
            <div class="form-group col-md-4">
              <label for="reason">免役原因</label>
              <input type="text" id="reason" name="reason" class="form-control" placeholder="" disabled>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-8">
              <label for="email">郵件信箱</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="EMail">
            </div>
            <div class="form-group col-md-4">
              <label for="phone">手機號碼</label>
              <input type="number" id="phone" name="phone" class="form-control" placeholder="0900123123">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-8">
              <label for="address">戶籍地址</label>
              <input type="text" id="address" name="address" class="form-control" placeholder="桃園市桃園區中正路100號">
            </div>
            <div class="form-group col-md-4">
              <label for="addressPhone">戶籍電話</label>
              <input type="number" id="addressPhone" name="addressPhone" class="form-control" placeholder="033381234">
            </div>
            <div class="form-group col-md-8">
              <label for="address2">通訊地址</label>
              <input type="text" id="address2" name="address2" class="form-control" placeholder="桃園市桃園區中正路1071號四樓之六">
            </div>
            <div class="form-group col-md-4">
              <label for="address2Phone">通訊電話</label>
              <input type="number" id="address2Phone" name="address2Phone" class="form-control" placeholder="033381234">
            </div>
          </div>
          <!-- 教育背景及專業課程 -->
          <p class="h3">教育背景</p>
          <hr>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="education">最高學歷</label>
              <select class="form-control form-select" id="education">
                <option>博士</option>
                <option>碩士</option>
                <option selected>大學</option>
                <option>四技</option>
                <option>二技</option>
                <option>二專</option>
                <option>三專</option>
                <option>五專</option>
                <option>高中</option>
                <option>高職</option>
                <option>國中(含)以下</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="school">學校名稱</label>
              <input type="text" id="school" name="school" class="form-control" placeholder="中央大學">
            </div>
            <div class="form-group col-md-4">
              <label for="department">科系名稱</label>
              <input type="text" id="department" name="department" class="form-control" placeholder="資訊工程系">
            </div>
            <div class="form-group col-md-4">
              <label for="schoolStatus">就學狀態</label>
              <select class="form-control form-select" id="schoolStatus">
                <option selected>畢業</option>
                <option>肄業</option>
                <option>就學中</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">就學期間</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">&nbsp;</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="education">次高學歷</label>
              <select class="form-control form-select" id="education">
                <option>博士</option>
                <option>碩士</option>
                <option>大學</option>
                <option>四技</option>
                <option>二技</option>
                <option>二專</option>
                <option>三專</option>
                <option>五專</option>
                <option selected>高中</option>
                <option>高職</option>
                <option>國中(含)以下</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="school">學校名稱</label>
              <input type="text" id="school" name="school" class="form-control" placeholder="武陵高中">
            </div>
            <div class="form-group col-md-4">
              <label for="department">科系名稱</label>
              <input type="text" id="department" name="department" class="form-control" placeholder="普通科">
            </div>
            <div class="form-group col-md-4">
              <label for="schoolStatus">就學狀態</label>
              <select class="form-control form-select" id="schoolStatus">
                <option selected>畢業</option>
                <option>肄業</option>
                <option>就學中</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">就學期間</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">&nbsp;</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
          </div>
          <hr>
          <!-- <div class="row">
            <div class="form-group col-md-4">
              <label for="education">第三高學歷</label>
              <select class="form-control form-select" id="education">
                <option>博士</option>
                <option>碩士</option>
                <option>大學</option>
                <option>四技</option>
                <option>二技</option>
                <option>二專</option>
                <option>三專</option>
                <option>五專</option>
                <option>高中</option>
                <option>高職</option>
                <option selected>國中</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="school">學校名稱</label>
              <input type="text" id="school" name="school" class="form-control" placeholder="中興國中">
            </div>
            <div class="form-group col-md-4">
              <label for="department">科系名稱</label>
              <input type="text" id="department" name="department" class="form-control" placeholder="普通科">
            </div>
            <div class="form-group col-md-4">
              <label for="schoolStatus">就學狀態</label>
              <select class="form-control form-select" id="schoolStatus">
                <option selected>畢業</option>
                <option>肄業</option>
                <option>就學中</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">就學期間</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
            <div class="form-group col-md-2">
              <label for="schoolDate">&nbsp;</label>
              <input type="month" id="schoolStartDateByYear" name="schoolStartDateByYear" class="form-control" value="">
            </div>
          </div> -->
          <!-- 工作經歷 -->
          <p class="h3">工作經歷</p>
          <hr>
          <!-- 工作一 -->
          <div class="row">
            <div class="form-group col-md-4">
              <label for="jobCompany">公司名稱</label>
              <input type="text" id="jobCompany" name="jobCompany" class="form-control" placeholder="米米科技股份有限公司">
            </div>
            <div class="form-group col-md-4">
              <label for="jobPlace">工作地點</label>
              <input type="text" id="jobPlace" name="jobPlace" class="form-control" placeholder="台北市中正區">
            </div>
            <div class="form-group col-md-4">
              <label for="jobTitle">職稱</label>
              <input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder="資深工程師">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">任職期間</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2018-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">&nbsp;</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2022-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobSalary">薪資待遇</label>
              <input type="number" id="jobSalary" name="jobSalary" class="form-control" placeholder="55000">
            </div>
            <div class="form-group col-md-12">
              <label for="jobContent">工作描述</label>
              <textarea class="form-control" id="jobContent" rows="5"
                placeholder="電商網站開發,主要負責架構規劃,資料庫設計,後端程式及API介接"></textarea>
            </div>
          </div>
          <hr>
          <!-- 工作二 -->
          <div class="row">
            <div class="form-group col-md-4">
              <label for="jobCompany">公司名稱</label>
              <input type="text" id="jobCompany" name="jobCompany" class="form-control" placeholder="阿米科技股份有限公司">
            </div>
            <div class="form-group col-md-4">
              <label for="jobPlace">工作地點</label>
              <input type="text" id="jobPlace" name="jobPlace" class="form-control" placeholder="台北市中正區">
            </div>
            <div class="form-group col-md-4">
              <label for="jobTitle">職稱</label>
              <input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder="工程師">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">任職期間</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2016-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">&nbsp;</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2018-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobSalary">薪資待遇</label>
              <input type="number" id="jobSalary" name="jobSalary" class="form-control" placeholder="50000">
            </div>
            <div class="form-group col-md-12">
              <label for="jobContent">工作描述</label>
              <textarea class="form-control" id="jobContent" rows="5" placeholder="網站開發,負責後端程式"></textarea>
            </div>
          </div>
          <hr>
          <!-- 工作三 -->
          <div class="row">
            <div class="form-group col-md-4">
              <label for="jobCompany">公司名稱</label>
              <input type="text" id="jobCompany" name="jobCompany" class="form-control" placeholder="米圖科技股份有限公司">
            </div>
            <div class="form-group col-md-4">
              <label for="jobPlace">工作地點</label>
              <input type="text" id="jobPlace" name="jobPlace" class="form-control" placeholder="台北市中正區">
            </div>
            <div class="form-group col-md-4">
              <label for="jobTitle">職稱</label>
              <input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder="助理工程師">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">任職期間</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2014-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">&nbsp;</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2016-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobSalary">薪資待遇</label>
              <input type="number" id="jobSalary" name="jobSalary" class="form-control" placeholder="40000">
            </div>
            <div class="form-group col-md-12">
              <label for="jobContent">工作描述</label>
              <textarea class="form-control" id="jobContent" rows="5" placeholder="網站測試, 報告撰寫"></textarea>
            </div>
          </div>
          <hr>
          <!-- 工作四 -->
          <div class="row">
            <div class="form-group col-md-4">
              <label for="jobCompany">公司名稱</label>
              <input type="text" id="jobCompany" name="jobCompany" class="form-control" placeholder="中央大學">
            </div>
            <div class="form-group col-md-4">
              <label for="jobPlace">工作地點</label>
              <input type="text" id="jobPlace" name="jobPlace" class="form-control" placeholder="桃園市中壢區">
            </div>
            <div class="form-group col-md-4">
              <label for="jobTitle">職稱</label>
              <input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder="工讀">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">任職期間</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2011-08-01">
            </div>
            <div class="form-group col-md-4">
              <label for="jobDate">&nbsp;</label>
              <input type="month" id="jobStartDateByYear" name="jobStartDateByYear" class="form-control"
                value="2014-06-30">
            </div>
            <div class="form-group col-md-4">
              <label for="jobSalary">薪資待遇</label>
              <input type="number" id="jobSalary" name="jobSalary" class="form-control" placeholder="28000">
            </div>
            <div class="form-group col-md-12">
              <label for="jobContent">工作描述</label>
              <textarea class="form-control" id="jobContent" rows="5" placeholder="電腦檢測"></textarea>
            </div>
          </div>

          <!-- 個人特質/專業能力 -->
          <p class="h3">專業能力</p>
          <hr>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="strength">個人優點</label>
              <input type="text" id="strength" name="strength" class="form-control" placeholder="大膽細心">
            </div>
            <div class="form-group col-md-6">
              <label for="weakness">個人缺點</label>
              <input type="text" id="weakness" name="weakness" class="form-control" placeholder="過於固執">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-3">
              <label for="languageEnglish">英文</label>
              <select class="form-control form-select" id="languageEnglish">
                <option>精通</option>
                <option>中等</option>
                <option>略懂</option>
                <option>不懂</option>
              </select>
            </div>

            <div class="form-group col-md-3">
              <label for="languageTaiwanese">台語</label>
              <select class="form-control form-select" id="languageTaiwanese">
                <option>精通</option>
                <option>中等</option>
                <option>略懂</option>
                <option>不懂</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="license">專業證照</label>
            <textarea class="form-control" id="license" rows="3"
              placeholder="Microsoft MVP, Google Cloud Digital Leader"></textarea>
          </div>
          <div class="form-group">
            <label for="skill">專業技能</label>
            <textarea class="form-control" id="skill" rows="3" placeholder="C#, ASP.NET, MSSQL, Git"></textarea>
          </div>
          <!-- 家庭狀況 -->
          <p class="h3">家庭狀況</p>
          <hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="familyTitle">稱謂</label>
              <input type="text" id="familyTitle" name="familyTitle" class="form-control" placeholder="父">
            </div>
            <div class="form-group col-md-2">
              <label for="familyName">姓名</label>
              <input type="text" id="familyName" name="familyName" class="form-control" placeholder="陳大米">
            </div>
            <div class="form-group col-md-2">
              <label for="familyAge">年齡</label>
              <input type="number" id="familyAge" name="familyAge" class="form-control" placeholder="70">
            </div>
            <div class="form-group col-md-2">
              <label for="familyJob">職業</label>
              <input type="text" id="familyJob" name="familyJob" class="form-control" placeholder="退休">
            </div>
          </div><hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="familyTitle">稱謂</label>
              <input type="text" id="familyTitle" name="familyTitle" class="form-control" placeholder="母">
            </div>
            <div class="form-group col-md-2">
              <label for="familyName">姓名</label>
              <input type="text" id="familyName" name="familyName" class="form-control" placeholder="黃大媽">
            </div>
            <div class="form-group col-md-2">
              <label for="familyAge">年齡</label>
              <input type="number" id="familyAge" name="familyAge" class="form-control" placeholder="68">
            </div>
            <div class="form-group col-md-2">
              <label for="familyJob">職業</label>
              <input type="text" id="familyJob" name="familyJob" class="form-control" placeholder="退休">
            </div>
          </div><hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="familyTitle">稱謂</label>
              <input type="text" id="familyTitle" name="familyTitle" class="form-control" placeholder="妻">
            </div>
            <div class="form-group col-md-2">
              <label for="familyName">姓名</label>
              <input type="text" id="familyName" name="familyName" class="form-control" placeholder="吳靜茹">
            </div>
            <div class="form-group col-md-2">
              <label for="familyAge">年齡</label>
              <input type="number" id="familyAge" name="familyAge" class="form-control" placeholder="38">
            </div>
            <div class="form-group col-md-2">
              <label for="familyJob">職業</label>
              <input type="text" id="familyJob" name="familyJob" class="form-control" placeholder="家管">
            </div>
          </div><hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="familyTitle">稱謂</label>
              <input type="text" id="familyTitle" name="familyTitle" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyName">姓名</label>
              <input type="text" id="familyName" name="familyName" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyAge">年齡</label>
              <input type="number" id="familyAge" name="familyAge" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyJob">職業</label>
              <input type="text" id="familyJob" name="familyJob" class="form-control" placeholder="">
            </div>
          </div><hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="familyTitle">稱謂</label>
              <input type="text" id="familyTitle" name="familyTitle" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyName">姓名</label>
              <input type="text" id="familyName" name="familyName" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyAge">年齡</label>
              <input type="number" id="familyAge" name="familyAge" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-2">
              <label for="familyJob">職業</label>
              <input type="text" id="familyJob" name="familyJob" class="form-control" placeholder="">
            </div>
          </div><hr>
          
          <!-- 推薦人 -->
          <p class="h3">推薦人</p>
          <hr>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="recommendName">姓名</label>
              <input type="text" id="recommendName" name="recommendName" class="form-control" placeholder="王小明">
            </div>
            <div class="form-group col-md-2">
              <label for="recommendPhone">電話</label>
              <input type="number" id="recommendPhone" name="recommendPhone" class="form-control"
                placeholder="0900123123">
            </div>
            <div class="form-group col-md-3">
              <label for="recommendBase">關係</label>
              <input type="text" id="recommendBase" name="recommendBase" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-2">
              <label for="recommendName">姓名</label>
              <input type="text" id="recommendName" name="recommendName" class="form-control" placeholder="王阿明">
            </div>
            <div class="form-group col-md-2">
              <label for="recommendPhone">電話</label>
              <input type="number" id="recommendPhone" name="recommendPhone" class="form-control"
                placeholder="0900123111">
            </div>
            <div class="form-group col-md-3">
              <label for="recommendBase">關係</label>
              <input type="text" id="recommendBase" name="recommendBase" class="form-control" placeholder="">
            </div>
          </div>
          <!-- 其他個人狀況 -->
          <!-- <p class="h3">其他個人狀況</p><br> -->

        </div>
        <div class="col-sm-12 c-form-footer text-center">
          <div class="btn-group btn-group-lg">
            <button type="button" class="btn btn-primary">儲存資料</button>
            <button type="button" class="btn btn-primary">預覽資料</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- script -->

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- custom -->
  <script>
    // 身心障礙
    $("#disability").on('change', function () {
      if ($(this).val() == 0) {
        $("#disabilityType").attr('disabled', 'disabled');
        $("#disabilityLevel").attr('disabled', 'disabled');
      } else {
        $("#disabilityType").removeAttr('disabled');
        $("#disabilityLevel").removeAttr('disabled');
      }
    });
    // 兵役狀況
    $("#military").on('change', function () {
      if ($(this).val() == 4) {
        $("#reason").removeAttr('disabled');
      } else {
        $("#reason").attr('disabled', 'disabled');
      }
    });
    // 上傳大頭照
    $('#userPhoto').on('click', function () {
      $('#uploadUserPhoto').trigger('click');
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#userPhoto').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

  </script>

</body>

</html>